<?php


namespace Fox\Controllers;

use \Fox\Core\Exceptions\Error,
    \Fox\Core\Exceptions\Forbidden,
    \Fox\Core\Exceptions\NotFound;

class FieldManager extends \Fox\Core\Controllers\Base
{
    protected function checkControllerAccess()
    {
        if (!$this->getUser()->isAdmin()) {
            throw new Forbidden();
        }
    }

    public function actionRead($params, $data)
    {
        $data = $this->container->make('fieldManager')->read($params['name'], $params['scope']);

        if (!isset($data)) {
            throw new NotFound();
        }

        return $data;
    }

    public function actionCreate($params, $data)
    {
        if (empty($data['name'])) {
            throw new Error("Field 'name' cannnot be empty");
        }
        
        $fieldManager = $this->container->make('fieldManager');
        $fieldManager->create($data['name'], $data, $params['scope']);

        try {
            $this->container->make('dataManager')->rebuild($params['scope']);
        } catch (Error $e) {
            $fieldManager->delete($data['name'], $params['scope']);
            throw new Error($e->getMessage());
        }

        return $fieldManager->read($data['name'], $params['scope']);
    }

    public function actionUpdate($params, $data)
    {
        $fieldManager = $this->container->make('fieldManager');
        $fieldManager->update($params['name'], $data, $params['scope']);

        if ($fieldManager->isChanged()) {
            $this->container->make('dataManager')->rebuild($params['scope']);
        } else {
            $this->container->make('dataManager')->clearCache();
        }

        return $fieldManager->read($params['name'], $params['scope']);
    }

    public function actionDelete($params, $data)
    {
        $res = $this->container->make('fieldManager')->delete($params['name'], $params['scope']);

        $this->container->make('dataManager')->rebuildMetadata();

        return $res;
    }

}

