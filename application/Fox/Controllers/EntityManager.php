<?php


namespace Fox\Controllers;

use \Fox\Core\Exceptions\BadRequest;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\Error;

class EntityManager extends \Fox\Core\Controllers\Base
{
    protected function checkControllerAccess()
    {
        if (!$this->getUser()->isAdmin()) {
            throw new Forbidden();
        }
    }

    public function actionCreateEntity($params, $data, $request)
    {
        if (!$request->isPost()) {
            throw new BadRequest();
        }

        if (empty($data['name']) || empty($data['type'])) {
            throw new BadRequest();
        }

        $name = $data['name'];
        $type = $data['type'];

        $name = filter_var($name, \FILTER_SANITIZE_STRING);
        $type = filter_var($type, \FILTER_SANITIZE_STRING);

        $params = array();

        if (!empty($data['labelSingular'])) {
            $params['labelSingular'] = $data['labelSingular'];
        }
        if (!empty($data['labelPlural'])) {
            $params['labelPlural'] = $data['labelPlural'];
        }
        if (!empty($data['stream'])) {
            $params['stream'] = $data['stream'];
        }
        if (!empty($data['disabled'])) {
            $params['disabled'] = $data['disabled'];
        }
        if (!empty($data['sortBy'])) {
            $params['sortBy'] = $data['sortBy'];
        }
        if (!empty($data['sortDirection'])) {
            $params['asc'] = $data['sortDirection'] === 'asc';
        }

        $result = $this->getcontainer()->make('entityManagerUtil')->create($name, $type, $params);

        if ($result) {
            $tabList = $this->getConfig()->get('tabList', []);
            $tabList[] = $name;
            $this->getConfig()->set('tabList', $tabList);
            $this->getConfig()->save();

            $this->getcontainer()->make('dataManager')->rebuild();
        } else {
            throw new Error();
        }

        return true;
    }

    public function actionUpdateEntity($params, $data, $request)
    {
        if (!$request->isPost()) {
            throw new BadRequest();
        }
        if (empty($data['name'])) {
            throw new BadRequest();
        }
        $name = $data['name'];
        $name = filter_var($name, \FILTER_SANITIZE_STRING);

        if (!empty($data['sortDirection'])) {
            $data['asc'] = $data['sortDirection'] === 'asc';
        }

        $result = $this->getcontainer()->make('entityManagerUtil')->update($name, $data);

        if ($result) {
            $this->getcontainer()->make('dataManager')->clearCache();
        } else {
            throw new Error();
        }

        return true;
    }

    public function actionRemoveEntity($params, $data, $request)
    {
        if (!$request->isPost()) {
            throw new BadRequest();
        }

        if (empty($data['name'])) {
            throw new BadRequest();
        }
        $name = $data['name'];
        $name = filter_var($name, \FILTER_SANITIZE_STRING);

        $result = $this->getcontainer()->make('entityManagerUtil')->delete($name);

        if ($result) {
            $tabList = $this->getConfig()->get('tabList', []);
            if (($key = array_search($name, $tabList)) !== false) {
                unset($tabList[$key]);
                $tabList = array_values($tabList);
            }
            $this->getConfig()->set('tabList', $tabList);
            $this->getConfig()->save();

            $this->getcontainer()->make('dataManager')->clearCache();
        } else {
            throw new Error();
        }

        return true;
    }

    public function actionCreateLink($params, $data, $request)
    {
        if (!$request->isPost()) {
            throw new BadRequest();
        }

        $paramList = [
        	'entity',
        	'entityForeign',
        	'link',
        	'linkForeign',
        	'label',
        	'labelForeign',
        	'linkType'
        ];

        $additionalParamList = [
            'relationName',
        ];

        $params = array();

        foreach ($paramList as $item) {
        	if (empty($data[$item])) {
        		throw new BadRequest();
        	}
        	$params[$item] = filter_var($data[$item], \FILTER_SANITIZE_STRING);
        }

        foreach ($additionalParamList as $item) {
            $params[$item] = filter_var($data[$item], \FILTER_SANITIZE_STRING);
        }

        if (array_key_exists('linkMultipleField', $data)) {
            $params['linkMultipleField'] = $data['linkMultipleField'];
        }
        if (array_key_exists('linkMultipleFieldForeign', $data)) {
            $params['linkMultipleFieldForeign'] = $data['linkMultipleFieldForeign'];
        }

        $result = $this->getcontainer()->make('entityManagerUtil')->createLink($params);

        if ($result) {
            $this->getcontainer()->make('dataManager')->rebuild();
        } else {
            throw new Error();
        }

        return true;
    }

    public function actionUpdateLink($params, $data, $request)
    {
        if (!$request->isPost()) {
            throw new BadRequest();
        }

        $paramList = [
        	'entity',
        	'entityForeign',
        	'link',
        	'linkForeign',
        	'label',
        	'labelForeign'
        ];

        $additionalParamList = [];

        $params = array();
        foreach ($paramList as $item) {
        	$params[$item] = filter_var($data[$item], \FILTER_SANITIZE_STRING);
        }

        foreach ($additionalParamList as $item) {
            $params[$item] = filter_var($data[$item], \FILTER_SANITIZE_STRING);
        }

        if (array_key_exists('linkMultipleField', $data)) {
            $params['linkMultipleField'] = $data['linkMultipleField'];
        }
        if (array_key_exists('linkMultipleFieldForeign', $data)) {
            $params['linkMultipleFieldForeign'] = $data['linkMultipleFieldForeign'];
        }

        $result = $this->getcontainer()->make('entityManagerUtil')->updateLink($params);

        if ($result) {
            $this->getcontainer()->make('dataManager')->clearCache();
        } else {
            throw new Error();
        }

        return true;
    }

    public function actionRemoveLink($params, $data, $request)
    {
        if (!$request->isPost()) {
            throw new BadRequest();
        }

        $paramList = [
        	'entity',
        	'link',
        ];
        $d = array();
        foreach ($paramList as $item) {
        	$d[$item] = filter_var($data[$item], \FILTER_SANITIZE_STRING);
        }

        $result = $this->getcontainer()->make('entityManagerUtil')->deleteLink($d);

        if ($result) {
            $this->getcontainer()->make('dataManager')->clearCache();
        } else {
            throw new Error();
        }

        return true;
    }
}

