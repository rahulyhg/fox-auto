<?php


namespace Fox\Services;

use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\NotFound;

use Fox\ORM\Entity;

use Fox\Core\Utils\Json;

class Notification extends \Fox\Services\Record
{
    protected function getEntityManager()
    {
        return $this->injections['entityManager'];
    }

    protected function getUser()
    {
        return $this->injections['user'];
    }

    protected function getMetadata()
    {
        return $this->injections['metadata'];
    }

    protected function getAclManager()
    {
        return $this->getInjection('aclManager');
    }

    public function notifyAboutMentionInPost($userId, $noteId)
    {
        $notification = $this->getEntityManager()->getEntity('Notification');
        $notification->set(array(
            'type' => 'MentionInPost',
            'data' => array('noteId' => $noteId),
            'userId' => $userId,
            'relatedId' => $noteId,
            'relatedType' => 'Note'
        ));
        $this->getEntityManager()->saveEntity($notification);
    }

    public function notifyAboutNote(array $userIdList, \Fox\Entities\Note $note)
    {
        $data = array('noteId' => $note->id);
        $encodedData = Json::encode($data);

        $now = date('Y-m-d H:i:s');
        $pdo = $this->getEntityManager()->getPDO();

        $sql = "INSERT INTO `notification` (`id`, `data`, `type`, `user_id`, `created_at`, `related_id`, `related_type`) VALUES ";
        $arr = [];
        foreach ($userIdList as $userId) {
            if (empty($userId)) continue;

            $user = $this->getEntityManager()->getEntity('User');
            $user->id = $userId;
            $user->setAsFetched();
            if (!$this->checkUserNoteAccess($user, $note)) {
                continue;
            }
            $id = uniqid();
            $arr[] = "(".$pdo->quote($id).", ".$pdo->quote($encodedData).", ".$pdo->quote('Note').", ".$pdo->quote($userId).", ".$pdo->quote($now).", ".$pdo->quote($note->id).", ".$pdo->quote('Note').")";
        }

        if (empty($arr)) {
            return;
        }

        $sql .= implode(", ", $arr);
        $pdo->query($sql);
    }

    public function checkUserNoteAccess(\Fox\Entities\User $user, \Fox\Entities\Note $note)
    {
        if (in_array($note->get('type'), ['EmailSent', 'EmailReceived'])) {
            if (!$this->getAclManager()->checkScope($user, 'Email')) {
                return false;
            }
        }
        if ($note->get('relatedType')) {
            if (!$this->getAclManager()->checkScope($user, $note->get('relatedType'))) {
                return false;
            }
        }

        if ($note->get('parentType')) {
            if (!$this->getAclManager()->checkScope($user, $note->get('parentType'))) {
                return false;
            }
        }

        return true;
    }

    public function getNotReadCount($userId)
    {
        $searchParams = array();
        $searchParams['whereClause'] = array(
            'userId' => $userId
        );
        return $this->getEntityManager()->getRepository('Notification')->where(array(
            'userId' => $userId,
            'read' => 0,
        ))->count();
    }

    public function markAllRead($userId)
    {
        $pdo = $this->getEntityManager()->getPDO();
        $sql = "UPDATE notification SET `read` = 1 WHERE user_id = ".$pdo->quote($userId)." AND `read` = 0";
        $pdo->prepare($sql)->execute();
        return true;
    }

    public function getList($userId, array $params = array())
    {
        $searchParams = array();

        $whereClause = array(
            'userId' => $userId
        );
        if (!empty($params['after'])) {
            $whereClause['createdAt>'] = $params['after'];
        }

        $searchParams['whereClause'] = $whereClause;

        if (array_key_exists('offset', $params)) {
            $searchParams['offset'] = $params['offset'];
        }
        if (array_key_exists('maxSize', $params)) {
            $searchParams['limit'] = $params['maxSize'];
        }
        $searchParams['orderBy'] = 'createdAt';
        $searchParams['order'] = 'DESC';

        $collection = $this->getEntityManager()->getRepository('Notification')->find($searchParams);
        $count = $this->getEntityManager()->getRepository('Notification')->count($searchParams);

        $ids = array();
        foreach ($collection as $k => $entity) {
            $ids[] = $entity->id;
            $data = $entity->get('data');
            if (empty($data)) {
                continue;
            }
            switch ($entity->get('type')) {
                case 'Note':
                case 'MentionInPost':
                    $note = $this->getEntityManager()->getEntity('Note', $data->noteId);
                    if ($note) {
                        if ($note->get('parentId') && $note->get('parentType')) {
                            $parent = $this->getEntityManager()->getEntity($note->get('parentType'), $note->get('parentId'));
                            if ($parent) {
                                $note->set('parentName', $parent->get('name'));
                            }
                        } else {
                            if (!$note->get('isGlobal')) {
                                $targetType = $note->get('targetType');
                                if (!$targetType || $targetType === 'users') {
                                    $note->loadLinkMultipleField('users');
                                }
                                if ($targetType !== 'users') {
                                    if (!$targetType || $targetType === 'teams') {
                                        $note->loadLinkMultipleField('teams');
                                    } else if ($targetType === 'portals') {
                                        $note->loadLinkMultipleField('portals');
                                    }
                                }
                            }
                        }
                        if ($note->get('relatedId') && $note->get('relatedType')) {
                            $related = $this->getEntityManager()->getEntity($note->get('relatedType'), $note->get('relatedId'));
                            if ($related) {
                                $note->set('relatedName', $related->get('name'));
                            }
                        }
                        $entity->set('noteData', $note->toArray());
                    } else {
                        unset($collection[$k]);
                        $count--;
                        $this->getEntityManager()->removeEntity($entity);
                    }
                    break;
            }
        }

        if (!empty($ids)) {
            $pdo = $this->getEntityManager()->getPDO();
            $sql = "UPDATE notification SET `read` = 1 WHERE id IN ('" . implode("', '", $ids) ."')";

            $s = $pdo->prepare($sql);
            $s->execute();
        }


        return array(
            'total' => $count,
            'collection' => $collection
        );
    }
}

