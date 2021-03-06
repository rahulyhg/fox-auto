<?php
namespace Fox\ORM;

abstract class Entity implements IEntity
{
    public $id = null;

    private $isNew = false;

    private $isSaved = false;
    
    // 是否开启回收站
    protected $isRecycled = null;
    
    // 是否为自增id
    protected $isAutoIncrement = null;

    /**
     * Entity type.
     * @var string
     */
    protected $entityType;

    /**
     * @var array Defenition of fields.
     * @todo make protected
     */
    public $fields = array();

    /**
     * @var array Defenition of relations.
     * @todo make protected
     */
    public $relations = array();

    /**
     * @var array Field-Value pairs.
     */
    protected $valuesContainer = array();

    /**
     * @var array Field-Value pairs of initial values (fetched from DB).
     */
    protected $fetchedValuesContainer = array();

    /**
     * @var EntityManager Entity Manager.
     */
    protected $entityManager;

    protected $isFetched = false;

    public function __construct($defs = array(), EntityManager $entityManager = null)
    {
        if (empty($this->entityType)) {
            $class = explode('\\', get_class($this));
            $this->entityType = end($class);
        }

        $this->entityManager = $entityManager;

        if (!empty($defs['fields'])) {
            $this->fields = $defs['fields'];
        }

        if (!empty($defs['relations'])) {
            $this->relations = $defs['relations'];
        }
    }

    // 是否为自增id
    public function isAutoIncrement()
    {
        if ($this->isAutoIncrement === null) {
            $this->isAutoIncrement = app('metadata')->get('scopes.' . $this->entityType . '.autoIncrement', false);
        }
        return $this->isAutoIncrement;
    }
    
    // 是否开启回收站模式
    public function isRecycled()
    {
        if ($this->isRecycled === null) {
            $this->isRecycled = app('metadata')->get('scopes.' . $this->entityType . '.recycled');
        }
        return $this->isRecycled;
    }

    public function clear($name = null)
    {
        if (is_null($name)) {
            $this->reset();
        }
        unset($this->valuesContainer[$name]);
    }

    public function reset()
    {
        $this->valuesContainer = array();
    }

    protected function setValue($name, $value)
    {
        $this->valuesContainer[$name] = $value;
    }

    public function set($p1, $p2 = null)
    {
        if (is_array($p1)) {
            if ($p2 === null) {
                $p2 = false;
            }
            $this->populateFromArray($p1, $p2);
        } else {
            $name = $p1;
            $value = $p2;
            if ($name == 'id') {
                $this->id = $value;
            }
            if ($this->hasAttribute($name)) {
                $method = '_set' . ucfirst($name);
                if (method_exists($this, $method)) {
                    $this->$method($value);
                } else {
                    $this->valuesContainer[$name] = $value;
                }
            }
        }
    }

    public function get($name, $params = array())
    {
        if ($name == 'id') {
            return $this->id;
        }
        $method = '_get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        if (isset($this->valuesContainer[$name])) {
            return $this->valuesContainer[$name];
        }

        if (!empty($this->relations[$name]) && $this->id) {
            $value = $this->entityManager->getRepository($this->getEntityType())->findRelated($this, $name, $params);
            return $value;
        }

        return null;
    }

    public function has($name)
    {
        if ($name == 'id') {
            return isset($this->id);
        }
        $method = '_has' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        if (isset($this->valuesContainer[$name])) {
            return true;
        }
        return false;
    }

    public function populateFromArray(array $arr, $onlyAccessible = true, $reset = false)
    {
        if ($reset) {
            $this->reset();
        }

        foreach ($this->getAttributes() as $field => & $fieldDefs) {
            if (isset($arr[$field])) {
                if ($field == 'id') {
                    $this->id = $arr[$field];
                    continue;
                }
                if ($onlyAccessible) {
                    if (isset($fieldDefs['notAccessible']) && $fieldDefs['notAccessible'] == true) {
                        continue;
                    }
                }

                $value = $arr[$field];

                if (!is_null($value)) {
                    switch ($fieldDefs['type']) {
                        case self::VARCHAR:
                            break;
                        case self::BOOL:
                            $value = ($value === 'true' || $value === '1' || $value === true);
                            break;
                        case self::INT:
                            $value = intval($value);
                            break;
                        case self::FLOAT:
                            $value = floatval($value);
                            break;
                        case self::JSON_ARRAY:
                            $value = is_string($value) ? json_decode($value) : $value;
                            if (!is_array($value)) {
                                $value = null;
                            }
                            break;
                        case self::JSON_OBJECT:
                            $value = is_string($value) ? json_decode($value) : $value;
                            if (!($value instanceof \stdClass) && !is_array($value)) {
                                $value = null;
                            }
                            break;
                        default:
                            break;
                    }
                }

                $method = '_set' . ucfirst($field);
                if (method_exists($this, $method)) {
                    $this->$method($value);
                } else {
                    $this->valuesContainer[$field] = $value;
                }
            }
        }
    }

    public function isNew()
    {
        return $this->isNew;
    }

    public function setIsNew($isNew)
    {
        $this->isNew = $isNew;
    }

    public function isSaved()
    {
        return $this->isSaved;
    }

    public function setIsSaved($isSaved)
    {
        $this->isSaved = $isSaved;
    }

    public function getEntityName()
    {
        return $this->getEntityType();
    }

    public function getEntityType()
    {
        return $this->entityType;
    }

    public function hasField($fieldName)
    {
        return isset($this->fields[$fieldName]);
    }

    public function hasAttribute($name)
    {
        return isset($this->fields[$name]);
    }

    public function hasRelation($relationName)
    {
        return isset($this->relations[$relationName]);
    }

    public function getValues()
    {
        return $this->toArray();
    }

    public function toArray()
    {
        $arr = array();
        if (isset($this->id)) {
            $arr['id'] = $this->id;
        }
        foreach ($this->fields as $field => & $defs) {
            if ($field == 'id') {
                continue;
            }
            if ($this->has($field)) {
                $arr[$field] = $this->get($field);
            }

        }
        return $arr;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function getAttributes()
    {
        return $this->fields;
    }

    public function getRelations()
    {
        return $this->relations;
    }

    public function getAttributeType($attribute)
    {
        if (isset($this->fields[$attribute]) && isset($this->fields[$attribute]['type'])) {
            return $this->fields[$attribute]['type'];
        }
        return null;
    }

    public function getRelationType($relation)
    {
        if (isset($this->relations[$relation]) && isset($this->relations[$relation]['type'])) {
            return $this->relations[$relation]['type'];
        }
        return null;
    }

    public function getAttributeParam($attribute, $name)
    {
        if (isset($this->fields[$attribute]) && isset($this->fields[$attribute][$name])) {
            return $this->fields[$attribute][$name];
        }
        return null;
    }

    public function getRelationParam($relation, $name)
    {
        if (isset($this->relations[$relation]) && isset($this->relations[$relation][$name])) {
            return $this->relations[$relation][$name];
        }
        return null;
    }

    public function isFetched()
    {
        return $this->isFetched;
    }

    public function isFieldChanged($fieldName)
    {
        return $this->has($fieldName) && ($this->get($fieldName) != $this->getFetched($fieldName));
    }

    public function isAttributeChanged($fieldName)
    {
        return $this->has($fieldName) && ($this->get($fieldName) != $this->getFetched($fieldName));
    }

    public function setFetched($fieldName, $value)
    {
        $this->fetchedValuesContainer[$fieldName] = $value;
    }

    public function getFetched($fieldName)
    {
        if (isset($this->fetchedValuesContainer[$fieldName])) {
            return $this->fetchedValuesContainer[$fieldName];
        }
        return null;
    }

    public function resetFetchedValues()
    {
        $this->fetchedValuesContainer = array();
    }

    public function updateFetchedValues()
    {
        $this->fetchedValuesContainer = $this->valuesContainer;
    }

    public function setAsFetched()
    {
        $this->isFetched = true;
        $this->fetchedValuesContainer = $this->valuesContainer;
    }

    public function populateDefaults()
    {
        foreach ($this->fields as $field => $defs) {
            if (array_key_exists('default', $defs)) {
                $this->valuesContainer[$field] = $defs['default'];
            }
        }
    }

    protected function getEntityManager()
    {
        return $this->entityManager;
    }
}
