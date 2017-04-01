<?php


namespace Fox\Core\AclPortal;

use \Fox\Core\Exceptions\Error;

use \Fox\ORM\Entity;
use \Fox\Entities\User;
use \Fox\Entities\Portal;

use \Fox\Core\Utils\Config;
use \Fox\Core\Utils\Metadata;
use \Fox\Core\Utils\FieldManager;
use \Fox\Core\Utils\File\Manager as FileManager;

class Table extends \Fox\Core\Acl\Table
{
    protected $type = 'aclPortal';

    protected $portal;

    protected $defaultAclType = 'recordAllOwnNo';

    protected $levelList = ['yes', 'all', 'account', 'contact', 'own', 'no'];

    protected $valuePermissionList = [];

    public function __construct(User $user, Portal $portal, Config $config = null, FileManager $fileManager = null, Metadata $metadata = null, FieldManager $fieldManager = null)
    {
        if (empty($portal)) {
            throw new Error("No portal was passed to AclPortal\\Table constructor.");
        }
        $this->portal = $portal;
        parent::__construct($user, $config, $fileManager, $metadata, $fieldManager);
    }

    protected function getPortal()
    {
        return $this->portal;
    }

    protected function initCacheFilePath()
    {
        $this->cacheFilePath = 'data/cache/application/acl-portal/'.$this->getPortal()->id.'/' . $this->getUser()->id . '.php';
    }

    protected function getRoleList()
    {
        $roleList = [];

        $userRoleList = $this->getUser()->get('portalRoles');
        foreach ($userRoleList as $role) {
            $roleList[] = $role;
        }

        $portalRoleList = $this->getPortal()->get('portalRoles');
        foreach ($portalRoleList as $role) {
            $roleList[] = $role;
        }

        return $roleList;
    }

    protected function getScopeWithAclList()
    {
        $scopeList = [];
        $scopes = $this->getMetadata()->get('scopes');
        foreach ($scopes as $scope => $d) {
            if (empty($d['acl'])) continue;
            if (empty($d['aclPortal'])) continue;
            $scopeList[] = $scope;
        }
        return $scopeList;
    }

    protected function applyDefault(&$table, &$fieldTable)
    {
        parent::applyDefault($table, $fieldTable);

        foreach ($this->getScopeList() as $scope) {
            if (!isset($table->$scope)) {
                $table->$scope = false;
            }
        }
    }

    protected function applyDisabled(&$table, &$fieldTable)
    {
        foreach ($this->getScopeList() as $scope) {
            $d = $this->getMetadata()->get('scopes.' . $scope);
            if ($d['disabled'] || $d['portalDisabled']) {
                $table->$scope = false;
                unset($fieldTable->$scope);
            }
        }
    }
}

