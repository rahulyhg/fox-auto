<?php


namespace Fox\Modules\Crm\Services;

use \Fox\ORM\Entity;

use \Fox\Core\Exceptions\NotFound;

class TargetList extends \Fox\Services\Record
{
    protected $noEditAccessRequiredLinkList = ['accounts', 'contacts', 'leads', 'users'];

    public function loadAdditionalFields(Entity $entity)
    {
        parent::loadAdditionalFields($entity);
        $this->loadEntryCountField($entity);
    }

    public function loadAdditionalFieldsForList(Entity $entity)
    {
        parent::loadAdditionalFields($entity);
        $this->loadEntryCountField($entity);
    }

    protected function loadEntryCountField(Entity $entity)
    {
        $count = 0;
        $count += $this->getEntityManager()->getRepository('TargetList')->countRelated($entity, 'contacts');
        $count += $this->getEntityManager()->getRepository('TargetList')->countRelated($entity, 'leads');
        $count += $this->getEntityManager()->getRepository('TargetList')->countRelated($entity, 'users');
        $count += $this->getEntityManager()->getRepository('TargetList')->countRelated($entity, 'accounts');
        $entity->set('entryCount', $count);
    }

    public function unlinkAll($id, $link)
    {
        $entity = $this->getRepository()->get($id);
        if (!$entity) {
            throw new NotFound();
        }
        if (!$this->getAcl()->check($entity, 'edit')) {
            throw new Forbidden();
        }

        $foreignEntityType = $entity->getRelationParam($link, 'entity');
        if (!$foreignEntityType) {
            throw new Error();
        }

        if (empty($foreignEntityType)) {
            throw new Error();
        }

        $pdo = $this->getEntityManager()->getPDO();
        $query = $this->getEntityManager()->getQuery();
        $sql = null;

        switch ($link) {
            case 'contacts':
                $sql = "UPDATE contact_target_list SET deleted = 1 WHERE target_list_id = " . $query->quote($entity->id);
                break;
            case 'leads':
                $sql = "UPDATE lead_target_list SET deleted = 1 WHERE target_list_id  = " . $query->quote($entity->id);
                break;
            case 'accounts':
                $sql = "UPDATE account_target_list SET deleted = 1 WHERE target_list_id  = " . $query->quote($entity->id);
                break;
            case 'users':
                $sql = "UPDATE target_list_user SET deleted = 1 WHERE target_list_id  = " . $query->quote($entity->id);
                break;
        }
        if ($sql) {
            if ($pdo->query($sql)) {
                return true;
            }
        }
    }

    protected function findLinkedEntitiesOptedOut($id, $params)
    {
        $collection = new \Fox\ORM\EntityCollection;

        $pdo = $this->getEntityManager()->getPDO();
        $query = $this->getEntityManager()->getQuery();

        $sqlContact = $query->createSelectQuery('Contact', array(
            'select' => ['id', 'name', 'createdAt', ['VALUE:Contact', '_scope']],
            'customJoin' => 'JOIN contact_target_list AS j ON j.contact_id = contact.id AND j.deleted = 0 AND j.opted_out = 1',
            'whereClause' => array(
                'j.targetListId' => $id
            )
        ));

        $sqlLead = $query->createSelectQuery('Lead', array(
            'select' => ['id', 'name', 'createdAt', ['VALUE:Lead', '_scope']],
            'customJoin' => 'JOIN lead_target_list AS j ON j.lead_id = lead.id AND j.deleted = 0 AND j.opted_out = 1',
            'whereClause' => array(
                'j.targetListId' => $id
            )
        ));

        $sqlUser = $query->createSelectQuery('User', array(
            'select' => ['id', 'name', 'createdAt', ['VALUE:User', '_scope']],
            'customJoin' => 'JOIN target_list_user AS j ON j.user_id = user.id AND j.deleted = 0 AND j.opted_out = 1',
            'whereClause' => array(
                'j.targetListId' => $id
            )
        ));

        $sqlAccount = $query->createSelectQuery('Account', array(
            'select' => ['id', 'name', 'createdAt', ['VALUE:Account', '_scope']],
            'customJoin' => 'JOIN account_target_list AS j ON j.account_id = account.id AND j.deleted = 0 AND j.opted_out = 1',
            'whereClause' => array(
                'j.targetListId' => $id
            )
        ));

        $sql = "
            {$sqlContact}
            UNION
            {$sqlLead}
            UNION
            {$sqlUser}
            UNION
            {$sqlAccount}
            ORDER BY createdAt DESC
        ";

        $sql = $query->limit($sql, $params['offset'], $params['maxSize']);

        $sth = $pdo->prepare($sql);
        $sth->execute();
        $arr = [];
        while ($row = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $arr[] = $row;
        }

        $sqlCount = "SELECT COUNT(*) AS 'count' FROM ({$sql}) AS c";
        $sth = $pdo->prepare($sqlCount);
        $sth->execute();

        $row = $sth->fetch(\PDO::FETCH_ASSOC);
        $count = $row['count'];

        return array(
            'total' => $count,
            'list' => $arr
        );
    }

    public function optOut($id, $targetType, $targetId)
    {
        $targetList = $this->getEntityManager()->getEntity('TargetList', $id);
        if (!$targetList) {
            throw new NotFound();
        }
        $target = $this->getEntityManager()->getEntity($targetType, $targetId);
        if (!$target) {
            throw new NotFound();
        }
        $map = array(
            'Account' => 'accounts',
            'Contact' => 'contacts',
            'Lead' => 'leads',
            'User' => 'users'
        );

        if (empty($map[$targetType])) {
            throw new Error();
        }
        $link = $map[$targetType];

        return $this->getEntityManager()->getRepository('TargetList')->relate($targetList, $link, $targetId, array(
            'optedOut' => true
        ));
    }

    public function cancelOptOut($id, $targetType, $targetId)
    {
        $targetList = $this->getEntityManager()->getEntity('TargetList', $id);
        if (!$targetList) {
            throw new NotFound();
        }
        $target = $this->getEntityManager()->getEntity($targetType, $targetId);
        if (!$target) {
            throw new NotFound();
        }
        $map = array(
            'Account' => 'accounts',
            'Contact' => 'contacts',
            'Lead' => 'leads',
            'User' => 'users'
        );

        if (empty($map[$targetType])) {
            throw new Error();
        }
        $link = $map[$targetType];

        return $this->getEntityManager()->getRepository('TargetList')->updateRelation($targetList, $link, $targetId, array(
            'optedOut' => false
        ));
    }
}

