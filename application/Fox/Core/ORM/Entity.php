<?php
namespace Fox\Core\ORM;

class Entity extends \Fox\ORM\Entity
{

    public function loadLinkMultipleField($field, $columns = null)
    {
        if (!$this->hasRelation($field) || !$this->hasAttribute($field . 'Ids')) return;

        $defs = array();
        if (!empty($columns)) {
            $defs['additionalColumns'] = $columns;
        }

        $collection = $this->get($field, $defs);
        $ids = array();
        $names = new \stdClass();
        $types = new \stdClass();
        if (!empty($columns)) {
            $columnsData = new \stdClass();
        }

        if ($collection) {
            foreach ($collection as $e) {
                $id = $e->id;
                $ids[] = $id;
                $names->$id = $e->get('name');
                $types->$id = $e->get('type');
                if (!empty($columns)) {
                    $columnsData->$id = new \stdClass();
                    foreach ($columns as $column => & $f) {
                        $columnsData->$id->$column = $e->get($f);
                    }
                }
            }
        }

        $this->set($field . 'Ids', $ids);
        $this->set($field . 'Names', $names);
        $this->set($field . 'Types', $types);
        if (!empty($columns)) {
            $this->set($field . 'Columns', $columnsData);
        }
    }

    public function loadLinkField($field)
    {
        if (!$this->hasRelation($field) || !$this->hasAttribute($field . 'Id')) return;
        if ($this->getRelationType($field) !== 'hasOne' && $this->getRelationType($field) !== 'belongsTo') return;

        $entity = $this->get($field);

        $entityId = null;
        $entityName = null;
        if ($entity) {
            $entityId = $entity->id;
            $entityName = $entity->get('name');
        }

        $this->set($field . 'Id', $entityId);
        $this->set($field . 'Name', $entityName);
    }

    public function getLinkMultipleColumn($field, $column, $id)
    {
        $columnsField = $field . 'Columns';

        if (!$this->has($columnsField)) {
            return;
        }
        $columns = $this->get($columnsField);
        if ($columns instanceof \StdClass) {
            if (isset($columns->$id)) {
                if (isset($columns->$id->$column)) {
                    return $columns->$id->$column;
                }
            }
        }

    }

    public function setLinkMultipleIdList($field, array $idList)
    {
        $idsField = $field . 'Ids';
        $this->set($idsField, $idList);
    }

    public function addLinkMultipleId($field, $id)
    {
        $idsField = $field . 'Ids';

        if (!$this->hasField($idsField)) return;

        if (!$this->has($idsField)) {
            if (!$this->isNew()) {
                $this->loadLinkMultipleField($field);
            } else {
                $this->set($idsField, []);
            }
        }
        if (!$this->has($idsField)) {
            return;
        }
        $idList = $this->get($idsField);
        if (!in_array($id, $idList)) {
            $idList[] = $id;
            $this->set($idsField, $idList);
        }
    }

    public function getLinkMultipleIdList($field)
    {
        $idsField = $field . 'Ids';

        if (!$this->hasAttribute($idsField)) return null;

        if (!$this->has($idsField)) {
            if (!$this->isNew()) {
                $this->loadLinkMultipleField($field);
            }
        }
        $valueList = $this->get($idsField);
        if (empty($valueList)) {
            return [];
        }
        return $valueList;
    }

    public function hasLinkMultipleId($field, $id)
    {
        $idsField = $field . 'Ids';

        if (!$this->hasAttribute($idsField)) return null;

        if (!$this->has($idsField)) {
            if (!$this->isNew()) {
                $this->loadLinkMultipleField($field);
            }
        }

        if (!$this->has($idsField)) {
            return;
        }

        $idList = $this->get($idsField);
        if (in_array($id, $idList)) {
            return true;
        }
        return false;
    }
}
