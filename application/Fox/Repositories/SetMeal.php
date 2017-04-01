<?php
namespace Fox\Repositories;

use \Fox\ORM\Entity;

class SetMeal extends \Fox\Core\ORM\Repositories\RDB
{
    protected function beforeSave(Entity $entity, array $options = array())
    {
        $s = $entity->get('sellingPrice');
        $entity->set('sellingPrice', $s * 1000);
        
        $o = $entity->get('orderPrice');
        $entity->set('orderPrice', $o * 1000);
        
        if ($entity->isNew()) {
            $entity->set('status', 0);
            $entity->set('auditById', '');
            $entity->set('auditAt', date('Y-m-d H:i:s', -1));
        }
        
        parent::beforeSave($entity, $options);
    }
}
