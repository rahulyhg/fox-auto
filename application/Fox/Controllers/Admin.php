<?php


namespace Fox\Controllers;

use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Error;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;

class Admin extends \Fox\Core\Controllers\Base
{
    protected function checkControllerAccess()
    {
        if (!$this->getUser()->isAdmin()) {
            throw new Forbidden();
        }
    }

    public function postActionRebuild($params, $data, $request)
    {
        if (!$request->isPost()) {
            throw new BadRequest();
        }
        $result = $this->getcontainer()->make('dataManager')->rebuild();

        return $result;
    }

    public function postActionClearCache($params, $data)
    {
        $result = $this->getcontainer()->make('dataManager')->clearCache();
        return $result;
    }

    public function actionJobs()
    {
        $scheduledJob = $this->getcontainer()->make('scheduledJob');

        return $scheduledJob->getAllNamesOnly();
    }

    public function postActionUploadUpgradePackage($params, $data)
    {
        if ($this->getConfig()->get('restrictedMode')) {
            if (!$this->getUser()->get('isSuperAdmin')) {
                throw new Forbidden();
            }
        }
        $upgradeManager = new \Fox\Core\UpgradeManager($this->getContainer());

        $upgradeId = $upgradeManager->upload($data);
        $manifest = $upgradeManager->getManifest();

        return array(
            'id' => $upgradeId,
            'version' => $manifest['version'],
        );
    }

    public function postActionRunUpgrade($params, $data)
    {
        if ($this->getConfig()->get('restrictedMode')) {
            if (!$this->getUser()->get('isSuperAdmin')) {
                throw new Forbidden();
            }
        }

        $upgradeManager = new \Fox\Core\UpgradeManager($this->getContainer());
        $upgradeManager->install($data);

        return true;
    }

    public function actionCronMessage($params, $data)
    {
        return $this->getcontainer()->make('scheduledJob')->getSetupMessage();
    }

    public function actionWechat($params, $data, $request){
        $companyId = $request->get('q');
        return $this->getService('Wechat')->find($companyId);
    }

    public function postActionWechat($params, $data, $request){
        if (!$request->isPost()) {
            throw new BadRequest();
        }
        return $this->getService('Wechat')->save($data);
    }

}

