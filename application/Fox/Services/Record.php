<?php
namespace Fox\Services;

use \Fox\ORM\Entity;

use \Fox\Core\Exceptions\Error;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;
use \Fox\Core\Exceptions\Conflict;
use \Fox\Core\Exceptions\NotFound;


use \Fox\Core\Utils\Util;

class Record extends \Fox\Core\Services\Base
{
    protected $dependencies = array(
        'entityManager',
        'user',
        'metadata',
        'acl',
        'aclManager',
        'config',
        'serviceFactory',
        'fileManager',
        'selectManagerFactory',
        'preferences'
    );

    protected $getEntityBeforeUpdate = false;

    private $streamService;

    protected $notFilteringAttributeList =[]; // TODO maybe remove it

    protected $internalAttributeList = [];

    protected $readOnlyAttributeList = [];

    protected $readOnlyLinkList = [];

    protected $linkSelectParams = [];

    protected $mergeLinkList = [];

    protected $noEditAccessRequiredLinkList = [];

    protected $exportSkipAttributeList = [];

    protected $exportAdditionalAttributeList = [];

    protected $checkForDuplicatesInUpdate = false;

    const FOLLOWERS_LIMIT = 4;

    public function setEntityType($entityType)
    {
        $this->entityType = $entityType;
        $this->entityName = $entityType;
    }

    public function getEntityType()
    {
        return $this->entityType;
    }

    protected function getServiceFactory()
    {
        return $this->injections['serviceFactory'];
    }

    protected function getSelectManagerFactory()
    {
        return $this->injections['selectManagerFactory'];
    }

    protected function getAcl()
    {
        return $this->injections['acl'];
    }

    protected function getFileManager()
    {
        return $this->injections['fileManager'];
    }

    protected function getPreferences()
    {
        return $this->injections['preferences'];
    }

    protected function getMetadata()
    {
        return $this->injections['metadata'];
    }

    protected function getRepository()
    {
        return $this->getEntityManager()->getRepository($this->entityType);
    }

    protected function getRecordService($name)
    {
        if ($this->getServiceFactory()->checkExists($name)) {
            $service = $this->getServiceFactory()->create($name);
        } else {
            $service = $this->getServiceFactory()->create('Record');
            $service->setEntityType($name);
        }

        return $service;
    }

    protected function prepareEntity($entity)
    {

    }

    public function getEntity($id = null)
    {
        $entity = $this->getRepository()->get($id);
        if (!empty($entity) && !empty($id)) {
            $this->loadAdditionalFields($entity);

            if (!$this->getAcl()->check($entity, 'read')) {
                throw new Forbidden();
            }
        }
        if (!empty($entity)) {
            $this->prepareEntityForOutput($entity);
        }
        return $entity;
    }

    protected function getStreamService()
    {
        if (empty($this->streamService)) {
            $this->streamService = $this->getServiceFactory()->create('Stream');
        }
        return $this->streamService;
    }

    protected function loadIsFollowed(Entity $entity)
    {
        if ($this->getStreamService()->checkIsFollowed($entity)) {
            $entity->set('isFollowed', true);
        } else {
            $entity->set('isFollowed', false);
        }
    }

    protected function loadFollowers(Entity $entity)
    {
        if ($this->getMetadata()->get("scopes.".$entity->getEntityType().".stream")) {
            $data = $this->getStreamService()->getEntityFollowers($entity, 0, self::FOLLOWERS_LIMIT);
            if ($data) {
                $entity->set('followersIds', $data['idList']);
                $entity->set('followersNames', $data['nameMap']);
            }
        }
    }

    protected function loadIsEditable(Entity $entity)
    {
        $entity->set('isEditable', $this->getAcl()->check($entity, 'edit'));
    }

    protected function loadLinkMultipleFields(Entity $entity)
    {
        $fieldDefs = $this->getMetadata()->get('entityDefs.' . $entity->getEntityType() . '.fields', array());
        foreach ($fieldDefs as $field => $defs) {
            if (isset($defs['type']) && in_array($defs['type'], ['linkMultiple', 'attachmentMultiple']) && empty($defs['noLoad'])) {
                $columns = null;
                if (!empty($defs['columns'])) {
                    $columns = $defs['columns'];
                }
                $entity->loadLinkMultipleField($field, $columns);
            }
        }
    }

    protected function loadLinkFields(Entity $entity)
    {
        $fieldDefs = $this->getMetadata()->get('entityDefs.' . $entity->getEntityType() . '.fields', array());
        $linkDefs = $this->getMetadata()->get('entityDefs.' . $entity->getEntityType() . '.links', array());
        foreach ($fieldDefs as $field => $defs) {
            if (isset($defs['type']) && $defs['type'] === 'link') {
                if (!empty($defs['noLoad'])) continue;
                if (empty($linkDefs[$field])) continue;
                if (empty($linkDefs[$field]['type'])) continue;
                if ($linkDefs[$field]['type'] !== 'hasOne') continue;

                $entity->loadLinkField($field);
            }
        }
    }

    protected function loadParentNameFields(Entity $entity)
    {
        $fieldDefs = $this->getMetadata()->get('entityDefs.' . $entity->getEntityType() . '.fields', array());
        foreach ($fieldDefs as $field => $defs) {
            if (isset($defs['type']) && $defs['type'] == 'linkParent') {
                $id = $entity->get($field . 'Id');
                $scope = $entity->get($field . 'Type');

                if ($scope) {
                    if ($foreignEntity = $this->getEntityManager()->getEntity($scope, $id)) {
                        $entity->set($field . 'Name', $foreignEntity->get('name'));
                    }
                }
            }
        }
    }

    protected function loadNotJoinedLinkFields(Entity $entity)
    {
        $linkDefs = $this->getMetadata()->get('entityDefs.' . $entity->getEntityType() . '.links', array());
        foreach ($linkDefs as $link => $defs) {
            if (isset($defs['type']) && $defs['type'] == 'belongsTo') {
                if (!empty($defs['noJoin']) && !empty($defs['entity'])) {
                    $nameField = $link . 'Name';
                    $idField = $link . 'Id';
                    if ($entity->hasAttribute($nameField) && $entity->hasAttribute($idField)) {
                        $id = $entity->get($idField);
                    }

                    $scope = $defs['entity'];
                    if (!empty($scope) && $foreignEntity = $this->getEntityManager()->getEntity($scope, $id)) {
                        $entity->set($nameField, $foreignEntity->get('name'));
                    }
                }
            }
        }
    }

    public function loadAdditionalFields(Entity $entity)
    {
        $this->loadLinkFields($entity);
        $this->loadLinkMultipleFields($entity);
        $this->loadParentNameFields($entity);
        $this->loadIsFollowed($entity);
        $this->loadFollowers($entity);
        $this->loadEmailAddressField($entity);
        $this->loadPhoneNumberField($entity);
        $this->loadNotJoinedLinkFields($entity);
        $this->loadIsEditable($entity);
    }

    public function loadAdditionalFieldsForList(Entity $entity)
    {
        $this->loadParentNameFields($entity);
    }

    public function loadAdditionalFieldsForExport(Entity $entity)
    {
    }

    protected function loadEmailAddressField(Entity $entity)
    {
        $fieldDefs = $this->getMetadata()->get('entityDefs.' . $entity->getEntityType() . '.fields', array());
        if (!empty($fieldDefs['emailAddress']) && $fieldDefs['emailAddress']['type'] == 'email') {
            $dataFieldName = 'emailAddressData';
            $entity->set($dataFieldName, $this->getEntityManager()->getRepository('EmailAddress')->getEmailAddressData($entity));
        }
    }

    protected function loadPhoneNumberField(Entity $entity)
    {
        $fieldDefs = $this->getMetadata()->get('entityDefs.' . $entity->getEntityType() . '.fields', array());
        if (!empty($fieldDefs['phoneNumber']) && $fieldDefs['phoneNumber']['type'] == 'phone') {
            $dataFieldName = 'phoneNumberData';
            $entity->set($dataFieldName, $this->getEntityManager()->getRepository('PhoneNumber')->getPhoneNumberData($entity));
        }
    }

    protected function getSelectManager($entityType)
    {
        return $this->getSelectManagerFactory()->create($entityType);
    }

    protected function storeEntity(Entity $entity)
    {
        return $this->getRepository()->save($entity);
    }

    protected function isValid($entity)
    {
        $fieldDefs = $entity->getAttributes();
        if ($entity->hasAttribute('name') && !empty($fieldDefs['name']['required'])) {
            if (!$entity->get('name')) {
                return false;
            }
        }

        return true;
    }

    public function checkAssignment(Entity $entity)
    {
        if (!$this->isPermittedAssignedUser($entity)) {
            return false;
        }
        if (!$this->isPermittedTeams($entity)) {
            return false;
        }
        return true;
    }

    public function isPermittedAssignedUser(Entity $entity)
    {
        if (!$entity->hasAttribute('assignedUserId')) {
            return true;
        }

        $assignedUserId = $entity->get('assignedUserId');

        if (empty($assignedUserId)) {
            return true;
        }

        $assignmentPermission = $this->getAcl()->get('assignmentPermission');

        if (empty($assignmentPermission) || $assignmentPermission === true || !in_array($assignmentPermission, ['team', 'no'])) {
            return true;
        }

        $toProcess = false;

        if (!$entity->isNew()) {
            if ($entity->isFieldChanged('assignedUserId')) {
                $toProcess = true;
            }
        } else {
            $toProcess = true;
        }

        if ($toProcess) {
            if ($assignmentPermission == 'no') {
                if ($this->getUser()->id != $assignedUserId) {
                    return false;
                }
            } else if ($assignmentPermission == 'team') {
                $teamIds = $this->getUser()->get('teamsIds');
                if (!$this->getEntityManager()->getRepository('User')->checkBelongsToAnyOfTeams($assignedUserId, $teamIds)) {
                    return false;
                }
            }
        }

        return true;
    }

    public function isPermittedTeams(Entity $entity)
    {
        $assignmentPermission = $this->getAcl()->get('assignmentPermission');

        if (empty($assignmentPermission) || $assignmentPermission === true || !in_array($assignmentPermission, ['team', 'no'])) {
            return true;
        }

        if (!$entity->hasAttribute('teamsIds')) {
            return true;
        }
        $teamIds = $entity->get('teamsIds');
        if (empty($teamIds)) {
            return true;
        }

        $newIds = [];

        if (!$entity->isNew()) {
            $existingIds = [];
            foreach ($entity->get('teams') as $team) {
                $existingIds[] = $team->id;
            }
            foreach ($teamIds as $id) {
                if (!in_array($id, $existingIds)) {
                    $newIds[] = $id;
                }
            }
        } else {
            $newIds = $teamIds;
        }

        if (empty($newIds)) {
            return true;
        }

        $userTeamIds = $this->getUser()->get('teamsIds');

        foreach ($newIds as $id) {
            if (!in_array($id, $userTeamIds)) {
                return false;
            }
        }
        return true;
    }

    protected function stripTags($string)
    {
        return strip_tags($string, '<a><img><p><br><span><ol><ul><li><blockquote><pre><h1><h2><h3><h4><h5><table><tr><td><th><thead><tbody><i><b>');
    }

    protected function filterInputAttribute($attribute, $value)
    {
        if (in_array($attribute, $this->notFilteringAttributeList)) {
            return $value;
        }
        $methodName = 'filterInputAttribute' . ucfirst($attribute);
        if (method_exists($this, $methodName)) {
            $value = $this->$methodName($value);
        }
        return $value;
    }

    protected function filterInput(&$data)
    {
        foreach ($this->readOnlyAttributeList as $attribute) {
            unset($data[$attribute]);
        }

        foreach ($data as $key => $value) {
            if (is_array($data[$key])) {
                foreach ($data[$key] as $i => $v) {
                    $data[$key][$i] = $this->filterInputAttribute($i, $data[$key][$i]);
                }
            } else if ($data[$key] instanceof \stdClass) {
                $propertyList = get_object_vars($data[$key]);
                foreach ($propertyList as $property => $value) {
                    $data[$key]->$property = $this->filterInputAttribute($property, $data[$key]->$property);
                }
            } else {
                $data[$key] = $this->filterInputAttribute($key, $data[$key]);
            }
        }

        foreach ($this->getAcl()->getScopeForbiddenAttributeList($this->entityType, 'edit') as $attribute) {
            unset($data[$attribute]);
        }
    }

    protected function handleInput(&$data)
    {

    }

    protected function processDuplicateCheck(Entity $entity, $data)
    {
        if (empty($data['forceDuplicate'])) {
            $duplicates = $this->checkEntityForDuplicate($entity, $data);
            if (!empty($duplicates)) {
                $reason = array(
                    'reason' => 'Duplicate',
                    'data' => $duplicates
                );
                throw new Conflict(json_encode($reason));
            }
        }
    }

    public function createEntity($data)
    {
        if (!$this->getAcl()->check($this->getEntityType(), 'create')) {
            throw new Forbidden();
        }

        $entity = $this->getRepository()->get();

        $this->filterInput($data);
        $this->handleInput($data);

        $entity->set($data);

        $this->beforeCreate($entity, $data);

        if (!$this->isValid($entity)) {
            throw new BadRequest();
        }

        if (!$this->checkAssignment($entity)) {
            throw new Forbidden();
        }

        $this->processDuplicateCheck($entity, $data);

        if ($this->storeEntity($entity)) {
            $this->afterCreate($entity, $data);
            $this->prepareEntityForOutput($entity);
            return $entity;
        }

        throw new Error();
    }


    public function updateEntity($id, $data)
    {
        unset($data['deleted']);

        if (empty($id)) {
            throw BadRequest();
        }

        $this->filterInput($data);
        $this->handleInput($data);

        if ($this->getEntityBeforeUpdate) {
            $entity = $this->getEntity($id);
        } else {
            $entity = $this->getRepository()->get($id);
        }

        if (!$entity) {
            throw new NotFound();
        }

        if (!$this->getAcl()->check($entity, 'edit')) {
            throw new Forbidden();
        }

        $dataBefore = $entity->getValues();

        $entity->set($data);

        $this->beforeUpdate($entity, $data);

        if (!$this->isValid($entity)) {
            throw new BadRequest();
        }

        if (!$this->checkAssignment($entity)) {
            throw new Forbidden();
        }

        if ($this->checkForDuplicatesInUpdate) {
            $this->processDuplicateCheck($entity, $data);
        }

        if ($this->storeEntity($entity)) {
            $this->afterUpdate($entity, $data);
            $this->prepareEntityForOutput($entity);
            return $entity;
        }

        throw new Error();
    }

    protected function beforeCreate(Entity $entity, array $data = array())
    {
    }

    protected function afterCreate(Entity $entity, array $data = array())
    {
    }

    protected function beforeUpdate(Entity $entity, array $data = array())
    {
    }

    protected function afterUpdate(Entity $entity, array $data = array())
    {
    }

    protected function beforeDelete(Entity $entity)
    {
    }

    protected function afterDelete(Entity $entity)
    {
    }

    public function deleteEntity($id)
    {
        if (empty($id)) {
            throw BadRequest();
        }

        $entity = $this->getRepository()->get($id);

        if (!$entity) {
            throw new NotFound();
        }

        if (!$this->getAcl()->check($entity, 'delete')) {
            throw new Forbidden();
        }

        $this->beforeDelete($entity);

        $result = $this->getRepository()->remove($entity);
        if ($result) {
            $this->afterDelete($entity);
            return $result;
        }
    }

    protected function getSelectParams($params)
    {
        $selectParams = $this->getSelectManager($this->entityType)->getSelectParams($params, true, true);

        return $selectParams;
    }

    public function findEntities($params)
    {
        $disableCount = false;
        if (in_array($this->entityType, $this->getConfig()->get('disabledCountQueryEntityList', array()))) {
            $disableCount = true;
        }

        $maxSize = 0;
        if ($disableCount) {
           if (!empty($params['maxSize'])) {
               $maxSize = $params['maxSize'];
               $params['maxSize'] = $params['maxSize'] + 1;
           }
        }

        $selectParams = $this->getSelectParams($params);

        $collection = $this->getRepository()->find($selectParams);

        foreach ($collection as $e) {
            $this->loadAdditionalFieldsForList($e);
            $this->prepareEntityForOutput($e);
        }

        if (!$disableCount) {
            $total = $this->getRepository()->count($selectParams);
        } else {
            if ($maxSize && count($collection) > $maxSize) {
                $total = -1;
                unset($collection[count($collection) - 1]);
            } else {
                $total = -2;
            }
        }

        return array(
            'total' => $total,
            'collection' => $collection,
        );
    }

    public function findLinkedEntities($id, $link, $params)
    {
        $entity = $this->getRepository()->get($id);
        if (!$entity) {
            throw new NotFound();
        }
        if (!$this->getAcl()->check($entity, 'read')) {
            throw new Forbidden();
        }

        $methodName = 'findLinkedEntities' . ucfirst($link);
        if (method_exists($this, $methodName)) {
            return $this->$methodName($id, $params);
        }

        $foreignEntityName = $entity->relations[$link]['entity'];

        if (!$this->getAcl()->check($foreignEntityName, 'read')) {
            throw new Forbidden();
        }

        $disableCount = false;
        if (in_array($foreignEntityName, $this->getConfig()->get('disabledCountQueryEntityList', array()))) {
            $disableCount = true;
        }

        $maxSize = 0;
        if ($disableCount) {
            if (!empty($params['maxSize'])) {
                $maxSize = $params['maxSize'];
                $params['maxSize'] = $params['maxSize'] + 1;
            }
        }

        $selectParams = $this->getSelectManager($foreignEntityName)->getSelectParams($params, true);

        if (array_key_exists($link, $this->linkSelectParams)) {
            $selectParams = array_merge($selectParams, $this->linkSelectParams[$link]);
        }

        $collection = $this->getRepository()->findRelated($entity, $link, $selectParams);

        $recordService = $this->getRecordService($foreignEntityName);

        foreach ($collection as $e) {
            $recordService->loadAdditionalFieldsForList($e);
            $recordService->prepareEntityForOutput($e);
        }

        if (!$disableCount) {
            $total = $this->getRepository()->countRelated($entity, $link, $selectParams);
        } else {
            if ($maxSize && count($collection) > $maxSize) {
                $total = -1;
                unset($collection[count($collection) - 1]);
            } else {
                $total = -2;
            }
        }

        return array(
            'total' => $total,
            'collection' => $collection
        );
    }

    public function linkEntity($id, $link, $foreignId)
    {
        if (empty($id) || empty($link) || empty($foreignId)) {
            throw new BadRequest;
        }

        if (in_array($link, $this->readOnlyLinkList)) {
            throw new Forbidden();
        }

        $entity = $this->getRepository()->get($id);
        if (!$entity) {
            throw new NotFound();
        }
        if (!$this->getAcl()->check($entity, 'edit')) {
            throw new Forbidden();
        }

        $foreignEntityType = $entity->getRelationParam($link, 'entity');
        if (!$foreignEntityType) {
            throw new Error("Entity '{$this->entityType}' has not relation '{$link}'.");
        }

        $foreignEntity = $this->getEntityManager()->getEntity($foreignEntityType, $foreignId);
        if (!$foreignEntity) {
            throw new NotFound();
        }

        $accessActionRequired = 'edit';
        if (in_array($link, $this->noEditAccessRequiredLinkList)) {
            $accessActionRequired = 'read';
        }
        if (!$this->getAcl()->check($foreignEntity, $accessActionRequired)) {
            throw new Forbidden();
        }

        $this->getRepository()->relate($entity, $link, $foreignEntity);
        return true;
    }

    public function unlinkEntity($id, $link, $foreignId)
    {
        if (empty($id) || empty($link) || empty($foreignId)) {
            throw new BadRequest;
        }

        if (in_array($link, $this->readOnlyLinkList)) {
            throw new Forbidden();
        }

        $entity = $this->getRepository()->get($id);
        if (!$entity) {
            throw new NotFound();
        }
        if (!$this->getAcl()->check($entity, 'edit')) {
            throw new Forbidden();
        }

        $foreignEntityType = $entity->getRelationParam($link, 'entity');
        if (!$foreignEntityType) {
            throw new Error("Entity '{$this->entityType}' has not relation '{$link}'.");
        }

        $foreignEntity = $this->getEntityManager()->getEntity($foreignEntityType, $foreignId);
        if (!$foreignEntity) {
            throw new NotFound();
        }

        $accessActionRequired = 'edit';
        if (in_array($link, $this->noEditAccessRequiredLinkList)) {
            $accessActionRequired = 'read';
        }
        if (!$this->getAcl()->check($foreignEntity, $accessActionRequired)) {
            throw new Forbidden();
        }

        $this->getRepository()->unrelate($entity, $link, $foreignEntity);
        return true;
    }

    public function linkEntityMass($id, $link, $where)
    {
        if (empty($id) || empty($link)) {
            throw new BadRequest;
        }

        $entity = $this->getRepository()->get($id);
        if (!$entity) {
            throw new NotFound();
        }
        if (!$this->getAcl()->check($entity, 'edit')) {
            throw new Forbidden();
        }

        $entityType = $entity->getEntityType();
        $foreignEntityType = $entity->getRelationParam($link, 'entity');

        if (empty($foreignEntityType)) {
            throw new Error();
        }

        $accessActionRequired = 'edit';
        if (in_array($link, $this->noEditAccessRequiredLinkList)) {
            $accessActionRequired = 'read';
        }

        if (!$this->getAcl()->check($foreignEntityType, $accessActionRequired)) {
            throw new Forbidden();
        }

        if (!is_array($where)) {
            $where = array();
        }
        $params['where'] = $where;

        $selectParams = $this->getRecordService($foreignEntityType)->getSelectParams($params);

        if ($this->getAcl()->getLevel($foreignEntityType, $accessActionRequired) === 'all') {
            return $this->getRepository()->massRelate($entity, $link, $selectParams);
        } else {
            $foreignEntityList = $this->getEntityManager()->getRepository($foreignEntityType)->find($selectParams);
            $countRelated = 0;
            foreach ($foreignEntityList as $foreignEntity) {
                if (!$this->getAcl()->check($foreignEntity, $accessActionRequired)) {
                    continue;
                }
                $this->getRepository()->relate($entity, $link, $foreignEntity);
                $countRelated++;
            }
            if ($countRelated) {
                return true;
            }
        }
    }

    public function massUpdate($attributes = array(), array $params)
    {
        $idsUpdated = array();
        $repository = $this->getRepository();

        $count = 0;

        $data = get_object_vars($attributes);
        $this->filterInput($data);

        if (array_key_exists('ids', $params) && is_array($params['ids'])) {
            $ids = $params['ids'];
            foreach ($ids as $id) {
                $entity = $this->getEntity($id);
                if ($this->getAcl()->check($entity, 'edit')) {
                    $entity->set($data);
                    if ($this->checkAssignment($entity)) {
                        if ($repository->save($entity)) {
                            $idsUpdated[] = $id;
                            $count++;
                        }
                    }
                }
            }
        }

        if (array_key_exists('where', $params)) {
            $where = $params['where'];
            $p = array();
            $p['where'] = $where;
            $selectParams = $this->getSelectParams($p);

            $collection = $repository->find($selectParams);

            foreach ($collection as $entity) {
                if ($this->getAcl()->check($entity, 'edit')) {
                    $entity->set($data);
                    if ($this->checkAssignment($entity)) {
                        if ($repository->save($entity)) {
                            $idsUpdated[] = $id;
                            $count++;
                        }
                    }
                }
            }

            return array(
                'count' => $count
            );
        }

        return array(
            'count' => $count,
            'ids' => $idsUpdated
        );
    }

    public function massRemove(array $params)
    {
        $idsRemoved = array();
        $repository = $this->getRepository();

        $count = 0;

        if (array_key_exists('ids',$params)) {
            $ids = $params['ids'];
            foreach ($ids as $id) {
                $entity = $this->getEntity($id);
                if ($entity && $this->getAcl()->check($entity, 'remove')) {
                    if ($repository->remove($entity)) {
                        $idsRemoved[] = $id;
                        $count++;
                    }
                }
            }
        }

        if (array_key_exists('where',$params)) {
            $where = $params['where'];
            $p = array();
            $p['where'] = $where;
            $selectParams = $this->getSelectParams($p);
            $collection = $repository->find($selectParams);

            foreach ($collection as $entity) {
                if ($this->getAcl()->check($entity, 'remove')) {
                    if ($repository->remove($entity)) {
                        $idsRemoved[] = $id;
                        $count++;
                    }
                }
            }
            return array(
                'count' => $count
            );
        }

        return array(
            'count' => $count,
            'ids' => $idsRemoved
        );
    }

    public function follow($id, $userId = null)
    {
        $entity = $this->getRepository()->get($id);

        if (!$this->getAcl()->check($entity, 'stream')) {
            throw new Forbidden();
        }

        if (empty($userId)) {
            $userId = $this->getUser()->id;
        }

        return $this->getStreamService()->followEntity($entity, $userId);
    }

    public function unfollow($id, $userId = null)
    {
        $entity = $this->getRepository()->get($id);

        if (!$this->getAcl()->check($entity, 'read')) {
            throw new Forbidden();
        }

        if (empty($userId)) {
            $userId = $this->getUser()->id;
        }

        return $this->getStreamService()->unfollowEntity($entity, $userId);
    }

    protected function getDuplicateWhereClause(Entity $entity, $data = array())
    {
        return false;
    }

    public function checkEntityForDuplicate(Entity $entity, $data = array())
    {
        $where = $this->getDuplicateWhereClause($entity, $data);

        if ($where) {
            if ($entity->id) {
                $where['id!='] = $entity->id;
            }
            $duplicateList = $this->getRepository()->where($where)->find();
            if (count($duplicateList)) {
                $result = array();
                foreach ($duplicateList as $e) {
                    $result[$e->id] = $e->getValues();
                }
                return $result;
            }
        }
        return false;
    }

    public function export(array $params)
    {
        if (array_key_exists('ids', $params)) {
            $ids = $params['ids'];
            $where = array(
                array(
                    'type' => 'in',
                    'field' => 'id',
                    'value' => $ids
                )
            );
            $selectParams = $this->getSelectManager($this->entityType)->getSelectParams(array('where' => $where), true, true);
        } else if (array_key_exists('where', $params)) {
            $where = $params['where'];

            $p = array();
            $p['where'] = $where;
            $selectParams = $this->getSelectParams($p);
        } else {
            throw new BadRequest();
        }

        $collection = $this->getRepository()->find($selectParams);

        $arr = array();

        $collection->toArray();

        $fieldListToSkip = array(
            'modifiedByName',
            'modifiedById',
            'modifiedAt',
            'deleted',
        );

        foreach ($this->exportSkipAttributeList as $attribute) {
            $fieldListToSkip[] = $attribute;
        }

        foreach ($this->getAcl()->getScopeForbiddenAttributeList($this->getEntityType(), 'read') as $attribute) {
            $fieldListToSkip[] = $attribute;
        }

        foreach ($this->internalAttributeList as $attribute) {
            $fieldListToSkip[] = $attribute;
        }

        $fieldList = null;
        foreach ($collection as $entity) {
            if (empty($fieldList)) {
                $fieldList = [];
                foreach ($entity->getAttributes() as $field => $defs) {
                    if (in_array($field, $fieldListToSkip)) {
                        continue;
                    }

                    if (empty($defs['notStorable'])) {
                        $fieldList[] = $field;
                    } else {
                        if (in_array($defs['type'], ['email', 'phone'])) {
                            $fieldList[] = $field;
                        } else if ($defs['name'] == 'name') {
                            $fieldList[] = $field;
                        }
                    }
                }
                foreach ($this->exportAdditionalAttributeList as $field) {
                    $fieldList[] = $field;
                }
            }

            $this->loadAdditionalFieldsForExport($entity);
            $row = array();
            foreach ($fieldList as $field) {
                $value = $this->getAttributeFromEntityForExport($entity, $field);
                $row[$field] = $value;
            }
            $arr[] = $row;
        }

        $delimiter = $this->getPreferences()->get('exportDelimiter');
        if (empty($delimiter)) {
            $delimiter = $this->getConfig()->get('exportDelimiter', ';');
        }

        $fp = fopen('php://temp', 'w');
        fputcsv($fp, array_keys($arr[0]), $delimiter);
        foreach ($arr as $row) {
            fputcsv($fp, $row, $delimiter);
        }
        rewind($fp);
        $csv = stream_get_contents($fp);
        fclose($fp);

        $fileName = "Export_{$this->entityType}.csv";

        $attachment = $this->getEntityManager()->getEntity('Attachment');
        $attachment->set('name', $fileName);
        $attachment->set('role', 'Export File');
        $attachment->set('type', 'text/csv');

        $this->getEntityManager()->saveEntity($attachment);

        if (!empty($attachment->id)) {
            $this->getInjection('fileManager')->putContents('data/upload/' . $attachment->id, $csv);
            // TODO cron job to remove file
            return $attachment->id;
        }
        throw new Error();
    }

    protected function getAttributeFromEntityForExport(Entity $entity, $field)
    {
        $methodName = 'getAttribute' . ucfirst($field). 'FromEntityForExport';
        if (method_exists($this, $methodName)) {
            return $this->$methodName($entity);
        }

        $defs = $entity->getAttributes();
        if (!empty($defs[$field]) && !empty($defs[$field]['type'])) {
            $type = $defs[$field]['type'];
            switch ($type) {
                case 'jsonArray':
                    $value = $entity->get($field);
                    if (is_array($value)) {
                        return implode(',', $value);
                    } else {
                        return null;
                    }
                    break;
                case 'password':
                    return null;
                    break;
            }
        }
        return $entity->get($field);
    }

    public function prepareEntityForOutput(Entity $entity)
    {
        foreach ($this->internalAttributeList as $field) {
            $entity->clear($field);
        }
        foreach ($this->getAcl()->getScopeForbiddenAttributeList($entity->getEntityType(), 'read') as $attribute) {
            $entity->clear($attribute);
        }
    }

    public function merge($id, array $sourceIds = array())
    {
        if (empty($id)) {
            throw new Error();
        }

        $entity = $this->getEntity($id);

        if (!$entity) {
            throw new NotFound();
        }

        if (!$this->getAcl()->check($entity, 'edit')) {
            throw new Forbidden();
        }

        $pdo = $this->getEntityManager()->getPDO();

        $sourceList = array();
        foreach ($sourceIds as $sourceId) {
            $source = $this->getEntity($sourceId);
            $sourceList[] = $source;
            if (!$this->getAcl()->check($source, 'edit') || !$this->getAcl()->check($source, 'delete')) {
                throw new Forbidden();
            }
        }

        foreach ($sourceList as $source) {
            $sql = "
                UPDATE `note`
                    SET
                        `parent_id` = " . $pdo->quote($entity->id) . ",
                        `parent_type` = " . $pdo->quote($entity->getEntityType()) . "
                WHERE
                    `type` IN ('Post', 'EmailSent', 'EmailReceived') AND
                    `parent_id` = " . $pdo->quote($source->id) . " AND
                    `parent_type` = ".$pdo->quote($source->getEntityType())." AND
                    `deleted` = 0
            ";
            $pdo->query($sql);
        }

        $repository = $this->getEntityManager()->getRepository($entity->getEntityType());

        foreach ($sourceList as $source) {
            foreach ($this->mergeLinkList as $link) {
                $linkedList = $repository->findRelated($source, $link);
                foreach ($linkedList as $linked) {
                    $repository->relate($entity, $link, $linked);
                }
            }
        }

        foreach ($sourceList as $source) {
            $this->getEntityManager()->removeEntity($source);
        }

        return true;
    }

    protected function findLinkedEntitiesFollowers($id, $params)
    {
        $maxSize = 0;
        if ($disableCount) {
            if (!empty($params['maxSize'])) {
                $maxSize = $params['maxSize'];
                $params['maxSize'] = $params['maxSize'] + 1;
            }
        }

        $entity = $this->getEntityManager()->getEntity($this->entityType, $id);
        if (!$entity) {
            throw new NotFound();
        }

        $data = $this->getStreamService()->getEntityFollowers($entity, $params['offset'], $params['maxSize']);

        $list = [];

        foreach ($data['idList'] as $id) {
            $list[] = array(
                'id' => $id,
                'name' => $data['nameMap']->$id
            );
        }

        if ($maxSize && count($list) > $maxSize) {
            $total = -1;
            unset($list[count($list) - 1]);
        } else {
            $total = -2;
        }

        return array(
            'total' => $total,
            'list' => $list
        );
    }
}

