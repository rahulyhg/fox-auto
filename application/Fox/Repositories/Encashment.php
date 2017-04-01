<?php
namespace Fox\Repositories;

use \Fox\ORM\Entity;

class Encashment extends \Fox\Core\ORM\Repositories\RDB
{
    protected function beforeSave(Entity $entity, array $options = array())
    {
        if ($entity->isNew()) {
            // 禁止新增
            die;
        }
        
        parent::beforeSave($entity, $options);
    }
}
