<?php


namespace Fox\Services;

use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Error;
use \Fox\Core\Exceptions\BadRequest;

use Fox\ORM\Entity;

class Import extends \Fox\Services\Record
{
    protected function init()
    {
        $this->dependencies[] = 'serviceFactory';
        $this->dependencies[] = 'fileManager';
        $this->dependencies[] = 'selectManagerFactory';
    }

    protected $dateFormatsMap = array(
        'YYYY-MM-DD' => 'Y-m-d',
        'DD-MM-YYYY' => 'd-m-Y',
        'MM-DD-YYYY' => 'm-d-Y',
        'MM/DD/YYYY' => 'm/d/Y',
        'DD/MM/YYYY' => 'd/m/Y',
        'DD.MM.YYYY' => 'd.m.Y',
        'MM.DD.YYYY' => 'm.d.Y',
        'YYYY.MM.DD' => 'Y.m.d',
    );

    protected $timeFormatsMap = array(
        'HH:mm' => 'H:i',
        'hh:mm a' => 'h:i a',
        'hh:mma' => 'h:ia',
        'hh:mm A' => 'h:iA',
        'hh:mmA' => 'h:iA',
    );

    protected $services = array();

    protected function getSelectManagerFactory()
    {
        return $this->injections['selectManagerFactory'];
    }

    protected function getFileManager()
    {
        return $this->injections['fileManager'];
    }

    protected function getAcl()
    {
        return $this->injections['acl'];
    }

    protected function getMetadata()
    {
        return $this->injections['metadata'];
    }

    protected function getServiceFactory()
    {
        return $this->injections['serviceFactory'];
    }

    public function loadAdditionalFields(Entity $entity)
    {
        parent::loadAdditionalFields($entity);

        $importedCount = $this->getRepository()->countRelated($entity, 'imported');
        $duplicateCount = $this->getRepository()->countRelated($entity, 'duplicates');
        $updatedCount = $this->getRepository()->countRelated($entity, 'updated');
        $entity->set(array(
            'importedCount' => $importedCount,
            'duplicateCount' => $duplicateCount,
            'updatedCount' => $updatedCount,
        ));
    }

    public function findLinkedEntities($id, $link, $params)
    {
        $entity = $this->getRepository()->get($id);
        $foreignEntityName = $entity->get('entityType');

        if (!$this->getAcl()->check($entity, 'read')) {
            throw new Forbidden();
        }
        if (!$this->getAcl()->check($foreignEntityName, 'read')) {
            throw new Forbidden();
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

        $total = $this->getRepository()->countRelated($entity, $link, $selectParams);

        return array(
            'total' => $total,
            'collection' => $collection
        );
    }

    protected function readCsvString(&$string, $CSV_SEPARATOR = ';', $CSV_ENCLOSURE = '"', $CSV_LINEBREAK = "\n")
    {
        $o = array();
        $cnt = strlen($string);
        $esc = false;
        $escesc = false;
        $num = 0;
        $i = 0;
        while ($i < $cnt) {
            $s = $string[$i];
            if ($s == $CSV_LINEBREAK) {
                if ($esc) {
                    $o[$num].= $s;
                }
                else {
                    $i++;
                    break;
                }
            }
            elseif ($s == $CSV_SEPARATOR) {
                if ($esc) {
                    $o[$num].= $s;
                }
                else {
                    $num++;
                    $esc = false;
                    $escesc = false;
                }
            }
            elseif ($s == $CSV_ENCLOSURE) {
                if ($escesc) {
                    $o[$num].= $CSV_ENCLOSURE;
                    $escesc = false;
                }

                if ($esc) {
                    $esc = false;
                    $escesc = true;
                }
                else {
                    $esc = true;
                    $escesc = false;
                }
            }
            else {
                if ($escesc) {
                    $o[$num].= $CSV_ENCLOSURE;
                    $escesc = false;
                }

                $o[$num].= $s;
            }

            $i++;
        }
        $string = substr($string, $i);
        return $o;
    }

    public function revert($id)
    {
        $import = $this->getEntityManager()->getEntity('Import', $id);
        if (empty($import)) {
            throw new NotFound();
        }

        $pdo = $this->getEntityManager()->getPDO();


        $sql = "SELECT * FROM import_entity WHERE import_id = ".$pdo->quote($import->id) . " AND is_imported = 1";

        $sth = $pdo->prepare($sql);
        $sth->execute();
        while ($row = $sth->fetch(\PDO::FETCH_ASSOC)) {
            if (empty($row['entity_type']) || empty($row['entity_id'])) {
                continue;
            }
            $entityType = $row['entity_type'];
            $entityId = $row['entity_id'];

            $entity = $this->getEntityManager()->getEntity($entityType, $entityId);
            if ($entity) {
                $this->getEntityManager()->removeEntity($entity);
            }
            $this->getEntityManager()->getRepository($entityType)->deleteFromDb($entityId);
        }

        $this->getEntityManager()->removeEntity($import);

        return true;
    }

    public function removeDuplicates($id)
    {
        $import = $this->getEntityManager()->getEntity('Import', $id);
        if (empty($import)) {
            throw new NotFound();
        }

        $pdo = $this->getEntityManager()->getPDO();


        $sql = "SELECT * FROM import_entity WHERE import_id = ".$pdo->quote($import->id) . " AND is_duplicate = 1";

        $sth = $pdo->prepare($sql);
        $sth->execute();
        while ($row = $sth->fetch(\PDO::FETCH_ASSOC)) {
            if (empty($row['entity_type']) || empty($row['entity_id'])) {
                continue;
            }
            $entityType = $row['entity_type'];
            $entityId = $row['entity_id'];

            $entity = $this->getEntityManager()->getEntity($entityType, $entityId);
            if ($entity) {
                $this->getEntityManager()->removeEntity($entity);
            }
            $this->getEntityManager()->getRepository($scope)->deleteFromDb($entityId);
        }

        return true;
    }

    public function import($scope, array $importFieldList, $attachmentId, array $params = array())
    {
        $delimiter = ',';
        if (!empty($params['fieldDelimiter'])) {
            $delimiter = $params['fieldDelimiter'];
        }
        $enclosure = '"';
        if (!empty($params['textQualifier'])) {
            $enclosure = $params['textQualifier'];
        }

        $contents = $this->getFileManager()->getContents('data/upload/' . $attachmentId);
        if (empty($contents)) {
            throw new Error('Import error');
        }

        $import = $this->getEntityManager()->getEntity('Import');
        $import->set(array(
            'entityType' => $scope,
            'fileId' => $attachmentId
        ));
        $this->getEntityManager()->saveEntity($import);

        $pdo = $this->getEntityManager()->getPDO();


        $result = array(
            'importedIds' => array(),
            'updatedIds' => array(),
            'duplicateIds' => array(),
        );
        $i = -1;

        $contents = str_replace("\r\n", "\n", $contents);

        while ($arr = $this->readCsvString($contents, $delimiter, $enclosure)) {
            $i++;
            if ($i == 0 && !empty($params['headerRow'])) {
                continue;
            }
            if (count($arr) == 1 && empty($arr[0])) {
                continue;
            }
            $r = $this->importRow($scope, $importFieldList, $arr, $params);
            if (empty($r)) {
                continue;
            }
            if (!empty($r['isImported'])) {
                $result['importedIds'][] = $r['id'];
            }
            if (!empty($r['isUpdated'])) {
                $result['updatedIds'][] = $r['id'];
            }
            if (!empty($r['isDuplicate'])) {
                $result['duplicateIds'][] = $r['id'];
            }
            $sql = "
                INSERT INTO import_entity
                (entity_type, entity_id, import_id, is_imported, is_updated, is_duplicate)
                VALUES
                (:entityType, :entityId, :importId, :isImported, :isUpdated, :isDuplicate)
            ";
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':entityType', $scope);
            $sth->bindValue(':entityId', $r['id']);
            $sth->bindValue(':importId', $import->id);
            $sth->bindValue(':isImported', !empty($r['isImported']), \PDO::PARAM_BOOL);
            $sth->bindValue(':isUpdated', !empty($r['isUpdated']), \PDO::PARAM_BOOL);
            $sth->bindValue(':isDuplicate', !empty($r['isDuplicate']), \PDO::PARAM_BOOL);

            $sth->execute();

        }
        return array(
            'id' => $import->id,
            'countCreated' => count($result['importedIds']),
            'countUpdated' => count($result['updatedIds']),
        );
    }

    public function importRow($scope, array $importFieldList, array $row, array $params = array())
    {
        $id = null;
        $action = 'create';
        if (!empty($params['action'])) {
            $action = $params['action'];
        }

        if (empty($importFieldList)) {
            return;
        }


        if (in_array($action, ['createAndUpdate', 'update'])) {
            if (!empty($params['updateBy']) && is_array($params['updateBy'])) {
                $updateByFieldList = [];
                $whereClause = array();
                foreach ($params['updateBy'] as $i) {
                    if (array_key_exists($i, $importFieldList)) {
                        $updateByFieldList[] = $importFieldList[$i];
                        $whereClause[$importFieldList[$i]] = $row[$i];
                    }
                }
            }
        }

        $recordService = $this->getRecordService($scope);

        if (in_array($action, ['createAndUpdate', 'update'])) {
            if (!count($updateByFieldList)) {
                return;
            }
            $entity = $this->getEntityManager()->getRepository($scope)->where($whereClause)->findOne();
            if (!$entity) {
                if ($action == 'createAndUpdate') {
                    $entity = $this->getEntityManager()->getEntity($scope);
                    if (array_key_exists('id', $whereClause)) {
                        $entity->set('id', $whereClause['id']);
                    }
                } else {
                    return;
                }
            }
        } else {
            $entity = $this->getEntityManager()->getEntity($scope);
        }

        $isNew = $entity->isNew();


        if (!empty($params['defaultValues'])) {
            $v = get_object_vars($params['defaultValues']);
            $entity->set($v);
        }

        $fieldsDefs = $entity->getFields();
        $relDefs = $entity->getRelations();

        $phoneFieldList = [];
        if (!empty($fieldsDefs['phoneNumber']) && !empty($fieldsDefs['phoneNumber']['type']) && $fieldsDefs['phoneNumber']['type'] == 'phone') {
            $typeList = $this->getMetadata()->get('entityDefs.' . $scope . '.fields.phoneNumber.typeList', []);
            foreach ($typeList as $type) {
                $attr = $field . str_replace(' ', '_', ucfirst($type));
                $phoneFieldList[] = 'phoneNumber' . $attr;
            }
        }

        foreach ($importFieldList as $i => $field) {
            if (!empty($field)) {
                $value = $row[$i];
                if ($field == 'id') {
                    if ($params['action'] == 'create') {
                        $entity->id = $value;
                    }
                    continue;
                }
                if (array_key_exists($field, $fieldsDefs)) {
                    if ($value !== '') {
                        $type = $this->getMetadata()->get("entityDefs.{$scope}.fields.{$field}.type");
                        if ($type == 'personName') {
                            $lastNameField = 'last' . ucfirst($field);
                            $firstNameField = 'first' . ucfirst($field);

                            $firstName = '';
                            $lastName = $value;
                            switch ($params['personNameFormat']) {
                                case 'f l':
                                    $pos = strpos($value, ' ');
                                    if ($pos) {
                                        $firstName = trim(substr($value, 0, $pos));
                                        $lastName = trim(substr($value, $pos + 1));
                                    }
                                    break;
                                case 'l f':
                                    $pos = strpos($value, ' ');
                                    if ($pos) {
                                        $lastName = trim(substr($value, 0, $pos));
                                        $firstName = trim(substr($value, $pos + 1));
                                    }
                                    break;
                                case 'l, f':
                                    $pos = strpos($value, ',');
                                    if ($pos) {
                                        $lastName = trim(substr($value, 0, $pos));
                                        $firstName = trim(substr($value, $pos + 1));
                                    }
                                    break;
                            }

                            if (!$entity->get($firstNameField)) {
                                $entity->set($firstNameField, $firstName);
                            }
                            if (!$entity->get($lastNameField)) {
                                $entity->set($lastNameField, $lastName);
                            }
                            continue;
                        }
                        $entity->set($field, $this->parseValue($entity, $field, $value, $params));
                    }
                } else {
                    if (in_array($field, $phoneFieldList) && !empty($value)) {
                        $phoneNumberData = $entity->get('phoneNumberData');
                        $isPrimary = false;
                        if (empty($phoneNumberData)) {
                            $phoneNumberData = [];
                            if (!in_array('phoneNumber', $importFieldList)) {
                                $isPrimary = true;
                            }
                        }
                        $type = str_replace('phoneNumber', '', $field);
                        $type = str_replace('_', ' ', $type);
                        $o = new \StdClass();
                        $o->phoneNumber = $value;
                        $o->type = $type;
                        $o->primary = $isPrimary;
                        $phoneNumberData[] = $o;

                        $entity->set('phoneNumberData', $phoneNumberData);
                    }
                }
            }
        }

        foreach ($importFieldList as $i => $field) {
            if (array_key_exists($field, $fieldsDefs) && $fieldsDefs[$field]['type'] == Entity::FOREIGN) {
                if ($entity->has($field)) {
                    $relation = $fieldsDefs[$field]['relation'];
                    if ($field == $relation . 'Name' && !$entity->has($relation . 'Id') && array_key_exists($relation, $relDefs)) {
                        if ($relDefs[$relation]['type'] == Entity::BELONGS_TO) {
                            $name = $entity->get($field);
                            $scope = $relDefs[$relation]['entity'];
                            $found = $this->getEntityManager()->getRepository($scope)->where(array('name' => $name))->findOne();

                            if ($found) {
                                $entity->set($relation . 'Id', $found->id);
                            } else {
                                if (!in_array($scope, 'User', 'Team')) {
                                    // TODO create related record with name $name and relate
                                }
                            }
                        }
                    }
                }
            }
        }

        $result = array();

        $a = $entity->toArray();

        try {
            if ($isNew) {
                $isDuplicate = $recordService->checkEntityForDuplicate($entity);
            }
            if ($this->getEntityManager()->saveEntity($entity, array('noStream' => true, 'noNotifications' => true))) {
                $result['id'] = $entity->id;
                if ($isNew) {
                    $result['isImported'] = true;
                    if ($isDuplicate) {
                        $result['isDuplicate'] = true;
                    }
                } else {
                    $result['isUpdated'] = true;
                }
            }
        } catch (\Exception $e) {
            logger()->error('Import: [' . $e->getCode() . '] ' .$e->getMessage());
        }

        return $result;
    }

    protected function parseValue(Entity $entity, $field, $value, $params = array())
    {
        $decimalMark = '.';
        if (!empty($params['decimalMark'])) {
            $decimalMark = $params['decimalMark'];
        }

        $defaultCurrency = 'USD';
        if (!empty($params['defaultCurrency'])) {
            $defaultCurrency = $params['defaultCurrency'];
        }

        $dateFormat = 'Y-m-d';
        if (!empty($params['dateFormat'])) {
            if (!empty($this->dateFormatsMap[$params['dateFormat']])) {
                $dateFormat = $this->dateFormatsMap[$params['dateFormat']];
            }
        }

        $timeFormat = 'H:i';
        if (!empty($params['timeFormat'])) {
            if (!empty($this->timeFormatsMap[$params['timeFormat']])) {
                $timeFormat = $this->timeFormatsMap[$params['timeFormat']];
            }
        }

        $fieldDefs = $entity->getFields();

        if (!empty($fieldDefs[$field])) {
            $type = $fieldDefs[$field]['type'];

            switch ($type) {
                case Entity::DATE:
                    $dt = \DateTime::createFromFormat($dateFormat, $value);
                    if ($dt) {
                        return $dt->format('Y-m-d');
                    }
                    break;
                case Entity::DATETIME:
                    $dt = \DateTime::createFromFormat($dateFormat . ' ' . $timeFormat, $value);
                    if ($dt) {
                        return $dt->format('Y-m-d H:i');
                    }
                    break;
                case Entity::FLOAT:
                    $currencyField = $field . 'Currency';
                    if ($entity->hasField($currencyField)) {
                        if (!$entity->has($currencyField)) {
                            $entity->set($currencyField, $defaultCurrency);
                        }
                    }

                    $a = explode($decimalMark, $value);
                    $a[0] = preg_replace('/[^A-Za-z0-9\-]/', '', $a[0]);

                    if (count($a) > 1) {
                        return $a[0] . '.' . $a[1];
                    } else {
                        return $a[0];
                    }
                    break;
            }
        }
        return $value;
    }

    protected function getRecordService($scope)
    {
        if (empty($this->services[$scope])) {
            if ($this->getServiceFactory()->checkExists($scope)) {
                $service = $this->getServiceFactory()->create($scope);
            } else {
                $service = $this->getServiceFactory()->create('Record');
                $service->setEntityType($scope);
            }
            $this->services[$scope] = $service;
        }
        return $this->services[$scope];
    }

    public function unmarkAsDuplicate($id, $entityType, $entityId)
    {
        $pdo = $this->getEntityManager()->getPDO();

        $sql = "
            UPDATE import_entity
            SET is_duplicate = 0
            WHERE
                import_id = ".$pdo->quote($id)." AND
                entity_type = ".$pdo->quote($entityType)." AND
                entity_id = ".$pdo->quote($entityId)."
        ";

        if ($pdo->query($sql)) {
            return true;
        }
    }
}

