<?php


namespace Fox\Core\Portal;

use \Fox\ORM\Entity;
use \Fox\Entities\User;

class Acl extends \Fox\Core\Acl
{
    public function checkReadOnlyAccount($scope)
    {
        return $this->getAclManager()->checkReadOnlyAccount($this->getUser(), $scope);
    }

    public function checkReadOnlyContact($scope)
    {
        return $this->getAclManager()->checkReadOnlyContact($this->getUser(), $scope);
    }

    public function checkInAccount(Entity $entity)
    {
        return $this->getAclManager()->checkInAccount($this->getUser(), $entity);
    }

    public function checkIsOwnContact(Entity $entity)
    {
        return $this->getAclManager()->checkIsOwnContact($this->getUser(), $entity);
    }
}

