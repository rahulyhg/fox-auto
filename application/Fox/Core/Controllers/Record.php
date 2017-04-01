<?php
namespace Fox\Core\Controllers;

use \Fox\Core\Exceptions\Error;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\BadRequest;
use \Fox\Core\Utils\Util;

class Record extends Base
{
    const MAX_SIZE_LIMIT = 200;

    public static $defaultAction = 'list';

    protected $defaultRecordServiceName = 'Record';
    
    protected function getEntityManager()
    {
        return $this->entityManager;
    }

    protected function getRecordService($name = null)
    {
        $name = $name ?: $this->name;

        if ($this->getServiceFactory()->checkExists($name)) {
            $service = $this->getServiceFactory()->create($name);
        } else {
            $service = $this->getServiceFactory()->create($this->defaultRecordServiceName);
            $service->setEntityType($name);
        }

        return $service;
    }

    public function actionRead($params)
    {
        $id = $params['id'];
        $entity = $this->getRecordService()->getEntity($id);

        if (empty($entity)) {
            throw new NotFound();
        }

        return $entity->toArray();
    }

    public function actionPatch($params, $data, $request)
    {
        return $this->actionUpdate($params, $data, $request);
    }

    public function actionCreate($params, $data, $request)
    {
        if (!$request->isPost()) {
            throw new BadRequest();
        }

        if (!$this->getAcl()->check($this->name, 'create')) {
            throw new Forbidden();
        }

        $service = $this->getRecordService();

        if ($entity = $service->createEntity($data)) {
            return $entity->toArray();
        }

        throw new Error();
    }

    public function actionUpdate($params, $data, $request)
    {
        if (!$request->isPut() && !$request->isPatch()) {
            throw new BadRequest();
        }

        if (!$this->getAcl()->check($this->name, 'edit')) {
            throw new Forbidden();
        }

        $id = $params['id'];

        if ($entity = $this->getRecordService()->updateEntity($id, $data)) {
            return $entity->toArray();
        }

        throw new Error();
    }

    public function actionList($params, $data, $request)
    {
        if (!$this->getAcl()->check($this->name, 'read')) {
            throw new Forbidden();
        }

        $where = $request->get('where');
        $offset = $request->get('offset');
        $maxSize = $request->get('maxSize');
        $asc = $request->get('asc') === 'true';
        $sortBy = $request->get('sortBy');
        $q = $request->get('q');
        $primaryFilter = $request->get('primaryFilter');
        $textFilter = $request->get('textFilter');
        $boolFilterList = $request->get('boolFilterList');

        if (empty($maxSize)) {
            $maxSize = self::MAX_SIZE_LIMIT;
        }
        if (!empty($maxSize) && $maxSize > self::MAX_SIZE_LIMIT) {
            throw new Forbidden("Max should should not exceed " . self::MAX_SIZE_LIMIT . ". Use pagination (offset, limit).");
        }

        $params = array(
            'where' => $where,
            'offset' => $offset,
            'maxSize' => $maxSize,
            'asc' => $asc,
            'sortBy' => $sortBy,
            'q' => $q,
            'textFilter' => $textFilter
        );
        if ($request->get('primaryFilter')) {
            $params['primaryFilter'] = $request->get('primaryFilter');
        }
        if ($request->get('boolFilterList')) {
            $params['boolFilterList'] = $request->get('boolFilterList');
        }

        $result = $this->getRecordService()->findEntities($params);

        return array(
            'total' => $result['total'],
            'list' => isset($result['collection']) ? $result['collection']->toArray() : $result['list']
        );
    }

    public function actionListLinked($params, $data, $request)
    {
        $id = $params['id'];
        $link = $params['link'];

        $where = $request->get('where');
        $offset = $request->get('offset');
        $maxSize = $request->get('maxSize');
        $asc = $request->get('asc') === 'true';
        $sortBy = $request->get('sortBy');
        $q = $request->get('q');
        $textFilter = $request->get('textFilter');

        if (empty($maxSize)) {
            $maxSize = self::MAX_SIZE_LIMIT;
        }
        if (!empty($maxSize) && $maxSize > self::MAX_SIZE_LIMIT) {
            throw new Forbidden();
        }

        $params = array(
            'where' => $where,
            'offset' => $offset,
            'maxSize' => $maxSize,
            'asc' => $asc,
            'sortBy' => $sortBy,
            'q' => $q,
            'textFilter' => $textFilter
        );
        if ($request->get('primaryFilter')) {
            $params['primaryFilter'] = $request->get('primaryFilter');
        }
        if ($request->get('boolFilterList')) {
            $params['boolFilterList'] = $request->get('boolFilterList');
        }

        $result = $this->getRecordService()->findLinkedEntities($id, $link, $params);

        return array(
            'total' => $result['total'],
            'list' => isset($result['collection']) ? $result['collection']->toArray() : $result['list']
        );
    }

    public function actionDelete($params, $data, $request)
    {
        if (!$request->isDelete()) {
            throw new BadRequest();
        }

        $id = $params['id'];

        if ($this->getRecordService()->deleteEntity($id)) {
            return true;
        }
        throw new Error();
    }

    public function actionExport($params, $data, $request)
    {
        if ($this->config->get('exportDisabled') && !$this->getUser()->isAdmin()) {
            throw new Forbidden();
        }

        if (!$this->getAcl()->check($this->name, 'read')) {
            throw new Forbidden();
        }

        $ids = $request->get('ids');
        $where = $request->get('where');
        $byWhere = $request->get('byWhere');

        $params = array();
        if ($byWhere) {
            $params['where'] = $where;
        } else {
            $params['ids'] = $ids;
        }

        return array(
            'id' => $this->getRecordService()->export($params)
        );
    }

    public function actionMassUpdate($params, $data, $request)
    {
        if (!$request->isPut()) {
            throw new BadRequest();
        }

        if (!$this->getAcl()->check($this->name, 'edit')) {
            throw new Forbidden();
        }
        if (empty($data['attributes'])) {
            throw new BadRequest();
        }

        $params = array();
        if (isset($data['where']) && !empty($data['byWhere'])) {
            $params['where'] = $data['where'];//json_decode(json_encode($data['where']), true);
        } else if (isset($data['ids'])) {
            $params['ids'] = $data['ids'];
        }

        $attributes = $data['attributes'];

        $idsUpdated = $this->getRecordService()->massUpdate($attributes, $params);

        return $idsUpdated;
    }

    public function actionMassDelete($params, $data, $request)
    {
        if (!$request->isPost()) {
            throw new BadRequest();
        }
        if (!$this->getAcl()->check($this->name, 'delete')) {
            throw new Forbidden();
        }

        $params = array();
        if (isset($data['where']) && !empty($data['byWhere'])) {
            $where = $data['where'];//json_decode(json_encode($data['where']), true);
            $params['where'] = $where;
        }
        if (isset($data['ids'])) {
            $where = $data['where']; //json_decode(json_encode($data['where']), true);
            $params['ids'] = $data['ids'];
        }

        $idsRemoved = $this->getRecordService()->massRemove($params);

        return $idsRemoved;
    }

    public function actionCreateLink($params, $data, $request)
    {
        if (!$request->isPost()) {
            throw new BadRequest();
        }

        if (empty($params['id']) || empty($params['link'])) {
            throw new BadRequest();
        }

        $id = $params['id'];
        $link = $params['link'];

        if (!empty($data['massRelate'])) {
            if (!is_array($data['where'])) {
                throw new BadRequest();
            }
            $where = $data['where'];//json_decode(json_encode($data['where']), true);
            return $this->getRecordService()->linkEntityMass($id, $link, $where);
        } else {
            $foreignIdList = array();
            if (isset($data['id'])) {
                $foreignIdList[] = $data['id'];
            }
            if (isset($data['ids']) && is_array($data['ids'])) {
                foreach ($data['ids'] as $foreignId) {
                    $foreignIdList[] = $foreignId;
                }
            }

            $result = false;
            foreach ($foreignIdList as & $foreignId) {
                if ($this->getRecordService()->linkEntity($id, $link, $foreignId)) {
                    $result = true;
                }
            }
            if ($result) {
                return true;
            }
        }

        throw new Error();
    }

    public function actionRemoveLink($params, $data, $request)
    {
        if (!$request->isDelete()) {
            throw new BadRequest();
        }

        $id = $params['id'];
        $link = $params['link'];

        if (empty($params['id']) || empty($params['link'])) {
            throw new BadRequest();
        }

        $foreignIds = array();
        if (isset($data['id'])) {
            $foreignIds[] = $data['id'];
        }
        if (isset($data['ids']) && is_array($data['ids'])) {
            foreach ($data['ids'] as $foreignId) {
                $foreignIds[] = $foreignId;
            }
        }

        $result = false;
        foreach ($foreignIds as & $foreignId) {
            if ($this->getRecordService()->unlinkEntity($id, $link, $foreignId)) {
                $result = $result || true;
            }
        }
        if ($result) {
            return true;
        }

        throw new Error();
    }

    public function actionFollow($params, $data, $request)
    {
        if (!$request->isPut()) {
            throw new BadRequest();
        }
        if (!$this->getAcl()->check($this->name, 'stream')) {
            throw new Forbidden();
        }
        $id = $params['id'];
        return $this->getRecordService()->follow($id);
    }

    public function actionUnfollow($params, $data, $request)
    {
        if (!$request->isDelete()) {
            throw new BadRequest();
        }
        if (!$this->getAcl()->check($this->name, 'read')) {
            throw new Forbidden();
        }
        $id = $params['id'];
        return $this->getRecordService()->unfollow($id);
    }

    public function actionMerge($params, $data, $request)
    {
        if (!$request->isPost()) {
            throw new BadRequest();
        }

        if (empty($data['targetId']) || empty($data['sourceIds']) || !is_array($data['sourceIds'])) {
            throw new BadRequest();
        }
        $targetId = $data['targetId'];
        $sourceIds = $data['sourceIds'];

        if (!$this->getAcl()->check($this->name, 'edit')) {
            throw new Forbidden();
        }

        return $this->getRecordService()->merge($targetId, $sourceIds);
    }
}
