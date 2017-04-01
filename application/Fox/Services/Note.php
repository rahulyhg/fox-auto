<?php


namespace Fox\Services;

use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\BadRequest;

use Fox\ORM\Entity;

class Note extends Record
{
    public function getEntity($id = null)
    {
        $entity = parent::getEntity($id);
        if (!empty($id)) {
            $entity->loadAttachments();
        }
        return $entity;
    }

    public function createEntity($data)
    {
        if (!empty($data['parentType']) && !empty($data['parentId'])) {
            $entity = $this->getEntityManager()->getEntity($data['parentType'], $data['parentId']);
            if ($entity) {
                if (!$this->getAcl()->check($entity, 'read')) {
                    throw new Forbidden();
                }
            }
        }

        return parent::createEntity($data);
    }

    protected function afterCreate(Entity $entity, array $data = array())
    {
        parent::afterCreate($entity, $data);
    }

    protected function beforeCreate(Entity $entity, array $data = array())
    {
        parent::beforeUpdate($entity, $data);
        $targetType = $entity->get('targetType');

        $entity->clear('isGlobal');

        switch ($targetType) {
            case 'all':
                $entity->clear('usersIds');
                $entity->clear('teamsIds');
                $entity->clear('portalsIds');
                $entity->set('isGlobal', true);
                break;
            case 'self':
                $entity->clear('usersIds');
                $entity->clear('teamsIds');
                $entity->clear('portalsIds');
                $entity->set('usersIds', [$this->getUser()->id]);
                $entity->set('isForSelf', true);
                break;
            case 'users':
                $entity->clear('teamsIds');
                $entity->clear('portalsIds');
                break;
            case 'teams':
                $entity->clear('usersIds');
                $entity->clear('portalsIds');
                break;
            case 'portals':
                $entity->clear('usersIds');
                $entity->clear('teamsIds');
                break;
        }
    }

    protected function beforeUpdate(Entity $entity, array $data = array())
    {
        parent::beforeUpdate($entity, $data);
        $entity->clear('targetType');
        $entity->clear('usersIds');
        $entity->clear('teamsIds');
        $entity->clear('portalsIds');
        $entity->clear('isGlobal');
    }


    public function checkAssignment(Entity $entity)
    {
        if ($entity->isNew()) {
            $targetType = $entity->get('targetType');

            if ($targetType) {
                $assignmentPermission = $this->getAcl()->get('assignmentPermission');
                if ($assignmentPermission === false || $assignmentPermission === 'no') {
                    if ($targetType !== 'self') {
                        throw new Forbidden('Not permitted to post to anybody except self.');
                    }
                }

                if ($targetType === 'teams') {
                    $teamIdList = $entity->get('teamsIds');
                    if (empty($teamIdList) || !is_array($teamIdList)) {
                        throw new BadRequest();
                    }
                }
                if ($targetType === 'users') {
                    $userIdList = $entity->get('usersIds');
                    if (empty($userIdList) || !is_array($userIdList)) {
                        throw new BadRequest();
                    }
                }
                if ($targetType === 'portals') {
                    $portalIdList = $entity->get('portalsIds');
                    if (empty($portalIdList) || !is_array($portalIdList)) {
                        throw new BadRequest();
                    }
                    if ($this->getAcl()->get('portalPermission') !== 'yes') {
                        throw new Forbidden('Not permitted to post to portal users.');
                    }
                }

                if ($assignmentPermission === 'team') {
                    if ($targetType === 'all') {
                        throw new Forbidden('Not permitted to post to all.');
                    }

                    $userTeamIdList = $this->getUser()->getTeamIdList();

                    if ($targetType === 'teams') {
                        if (empty($userTeamIdList)) {
                            throw new Forbidden('Not permitted to post to foreign teams.');
                        }
                        foreach ($teamIdList as $teamId) {
                            if (!in_array($teamId, $userTeamIdList)) {
                                throw new Forbidden('Not permitted to post to foreign teams.');
                            }
                        }
                    } else if ($targetType === 'users') {
                        if (empty($userTeamIdList)) {
                            throw new Forbidden('Not permitted to post to users from foreign teams.');
                        }

                        foreach ($userIdList as $userId) {
                            if ($userId === $this->getUser()->id) {
                                continue;
                            }
                            if (!$this->getEntityManager()->getRepository('User')->checkBelongsToAnyOfTeams($userId, $userTeamIdList)) {
                                throw new Forbidden('Not permitted to post to users from foreign teams.');
                            }
                        }
                    }
                }
            }
        }
        return true;
    }

    public function linkEntity($id, $link, $foreignId)
    {
        if ($link === 'teams' || $link === 'users') {
            throw new Forbidden();
        }
        return parant::linkEntity($id, $link, $foreignId);
    }


    public function unlinkEntity($id, $link, $foreignId)
    {
        if ($link === 'teams' || $link === 'users') {
            throw new Forbidden();
        }
        return parant::unlinkEntity($id, $link, $foreignId);
    }

}

