<?php
namespace Fox\Core;

use \Fox\ORM\Entity;
use \Fox\Entities\User;

class Acl
{
    private $user;

    private $aclManager;

    public function __construct(AclManager $aclManager, User $user)
    {
        $this->aclManager = $aclManager;
        $this->user = $user;
    }

    public function getMap()
    {
        return $this->aclManager->getMap($this->user);
    }

    public function getLevel($scope, $action)
    {
        return $this->aclManager->getLevel($this->user, $scope, $action);
    }

    public function get($permission)
    {
        return $this->aclManager->get($this->user, $permission);
    }

    public function checkReadOnlyTeam($scope)
    {
        return $this->aclManager->checkReadOnlyTeam($this->user, $scope);
    }

    public function checkReadOnlyOwn($scope)
    {
        return $this->aclManager->checkReadOnlyOwn($this->user, $scope);
    }

    public function check($subject, $action = null)
    {
        return $this->aclManager->check($this->user, $subject, $action);
    }

    public function checkScope($scope, $action = null)
    {
        return $this->aclManager->checkScope($this->user, $scope, $action);
    }

    public function checkEntity(Entity $entity, $action = 'read')
    {
        return $this->aclManager->checkEntity($this->user, $entity, $action);
    }

    public function checkUser($permission, User $entity)
    {
        return $this->aclManager->checkUser($this->user, $permission, $entity);
    }

    public function checkIsOwner(Entity $entity)
    {
        return $this->aclManager->checkIsOwner($this->user, $entity);
    }

    public function checkInTeam(Entity $entity)
    {
        return $this->aclManager->checkInTeam($this->user, $entity);
    }

    public function getScopeForbiddenAttributeList($scope, $action = 'read', $thresholdLevel = 'no')
    {
        return $this->aclManager->getScopeForbiddenAttributeList($this->user, $scope, $action, $thresholdLevel);
    }

    public function getScopeForbiddenFieldList($scope, $action = 'read', $thresholdLevel = 'no')
    {
        return $this->aclManager->getScopeForbiddenFieldList($this->user, $scope, $action, $thresholdLevel);
    }
}
