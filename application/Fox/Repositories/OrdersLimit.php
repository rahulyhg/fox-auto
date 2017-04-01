<?php
namespace Fox\Repositories;

use \Fox\ORM\Entity;

class OrdersLimit extends \Fox\Core\ORM\Repositories\RDB
{
    protected function beforeSave(Entity $entity, array $options = array())
    {
        if ($entity->isNew()) {
            $entity->set('status', 0);
            $entity->set('auditById', '');
            $entity->set('auditAt', date('Y-m-d H:i:s', -1));
            $entity->set('desc', '');
        }
        
        parent::beforeSave($entity, $options);
    }
}
