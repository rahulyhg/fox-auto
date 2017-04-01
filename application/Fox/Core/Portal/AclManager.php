<?php


namespace Fox\Core\Portal;

use \Fox\ORM\Entity;
use \Fox\Entities\User;
use \Fox\Core\Utils\Util;

class AclManager extends \Fox\Core\AclManager
{
    protected $tableClassName = '\\Fox\\Core\\AclPortal\\Table';

    public function getImplementation($scope)
    {
        if (empty($this->implementationHashMap[$scope])) {
            $normalizedName = Util::normilizeClassName($scope);

            $className = '\\Fox\\Custom\\AclPortal\\' . $normalizedName;
            if (!class_exists($className)) {
                $moduleName = $this->getMetadata()->getScopeModuleName($scope);
                if ($moduleName) {
                    $className = '\\Fox\\Modules\\' . $moduleName . '\\AclPortal\\' . $normalizedName;
                } else {
                    $className = '\\Fox\\AclPortal\\' . $normalizedName;
                }
                if (!class_exists($className)) {
                    $className = '\\Fox\\Core\\AclPortal\\Base';
                }
            }

            if (class_exists($className)) {
                $acl = new $className($scope);
                $dependencies = $acl->getDependencyList();
                foreach ($dependencies as $name) {
                    $acl->inject($name, $this->getcontainer()->make($name));
                }
                $this->implementationHashMap[$scope] = $acl;
            } else {
                throw new Error();
            }
        }

        return $this->implementationHashMap[$scope];
    }

    protected function getTable(User $user)
    {
        $key = spl_object_hash($user);

        if (empty($this->tableHashMap[$key])) {
            $config = $this->getcontainer()->make('config');
            $fileManager = $this->getcontainer()->make('fileManager');
            $metadata = $this->getcontainer()->make('metadata');
            $fieldManager = $this->getcontainer()->make('fieldManager');
            $portal = $this->getcontainer()->make('portal');

            $this->tableHashMap[$key] = new $this->tableClassName($user, $portal, $config, $fileManager, $metadata, $fieldManager);
        }

        return $this->tableHashMap[$key];
    }

    public function checkReadOnlyAccount(User $user, $scope)
    {
        if ($user->isAdmin()) {
            return false;
        }
        $data = $this->getTable($user)->getScopeData($scope);
        return $this->getImplementation($scope)->checkReadOnlyAccount($user, $data);
    }

    public function checkReadOnlyContact(User $user, $scope)
    {
        if ($user->isAdmin()) {
            return false;
        }
        $data = $this->getTable($user)->getScopeData($scope);
        return $this->getImplementation($scope)->checkReadOnlyContact($user, $data);
    }

    public function checkInAccount(User $user, Entity $entity, $action)
    {
        return $this->getImplementation($entity->getEntityType())->checkInAccount($user, $entity);
    }

    public function checkIsOwnContact(User $user, Entity $entity, $action)
    {
        return $this->getImplementation($entity->getEntityType())->checkIsOwnContact($user, $entity);
    }

}

