<?php


namespace Fox\Acl;

use \Fox\Entities\User;
use \Fox\ORM\Entity;

class Notification extends \Fox\Core\Acl\Base
{
    public function checkIsOwner(User $user, Entity $entity)
    {
        if ($user->id === $entity->get('userId')) {
            return true;
        }
        return false;
    }
}

