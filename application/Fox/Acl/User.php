<?php


namespace Fox\Acl;

use \Fox\ORM\Entity;

class User extends \Fox\Core\Acl\Base
{
    public function checkIsOwner(\Fox\Entities\User $user, Entity $entity)
    {
        return $user->id === $entity->id;
    }
}

