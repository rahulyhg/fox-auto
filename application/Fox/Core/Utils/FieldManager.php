<?php
namespace Fox\Core\Utils;

use \Fox\Core\Exceptions\Error,
    \Fox\Core\Exceptions\Conflict;

class FieldManager
{
    private $metadata;

    private $language;

    private $metadataHelper;

    protected $isChanged = null;

    protected $metadataType = 'entityDefs';

    protected $customOptionName = 'isCustom';

    public function __construct(Metadata $metadata, Language $language)
    {
        $this->metadata = $metadata;
        $this->language = $language;

        $this->metadataHelper = $metadata->getMetadataHelper();//new \Fox\Core\Utils\Metadata\Helper($this->metadata);
    }

    public function read($name, $scope)
    {
        $fieldDefs = $this->getFieldDefs($name, $scope);

        $fieldDefs['label'] = $this->language->translate($name, 'fields', $scope);

        return $fieldDefs;
    }

    public function create($name, $fieldDefs, $scope)
    {
        $existingField = $this->getFieldDefs($name, $scope);
        if (isset($existingField)) {
            throw new Conflict('Field ['.$name.'] exists in '.$scope);
        }

        return $this->update($name, $fieldDefs, $scope);
    }

    public function update($name, $fieldDefs, $scope)
    {
        /*Add option to metadata to identify the custom field*/
        if (!$this->isCore($name, $scope)) {
            $fieldDefs[$this->customOptionName] = true;
        }

        $res = true;
        if (isset($fieldDefs['label'])) {
            $this->setLabel($name, $fieldDefs['label'], $scope);
        }

        if (isset($fieldDefs['type']) && ($fieldDefs['type'] == 'enum' || $fieldDefs['type'] == 'phone')) {
            if (isset($fieldDefs['translatedOptions'])) {
                $this->setTranslatedOptions($name, $fieldDefs['translatedOptions'], $scope);
            }
        }

        if (isset($fieldDefs['label']) || isset($fieldDefs['translatedOptions'])) {
            $res &= $this->language->save();
        }

        if ($this->isDefsChanged($name, $fieldDefs, $scope)) {
            $res &= $this->setEntityDefs($name, $fieldDefs, $scope);
        }

        return (bool) $res;
    }

    public function delete($name, $scope)
    {
        if ($this->isCore($name, $scope)) {
            throw new Error('Cannot delete core field ['.$name.'] in '.$scope);
        }

        $unsets = array(
            'fields.'.$name,
            'links.'.$name,
        );

        $this->metadata->delete($this->metadataType, $scope, $unsets);
        $res = $this->metadata->save();
        $res &= $this->deleteLabel($name, $scope);

        return (bool) $res;
    }

    protected function setEntityDefs($name, $fieldDefs, $scope)
    {
        $fieldDefs = $this->normalizeDefs($name, $fieldDefs, $scope);

        $this->metadata->set($this->metadataType, $scope, $fieldDefs);
        $res = $this->metadata->save();

        return $res;
    }

    protected function setTranslatedOptions($name, $value, $scope)
    {
        return $this->language->set($scope, 'options', $name, $value);
    }

    protected function setLabel($name, $value, $scope)
    {
        return $this->language->set($scope, 'fields', $name, $value);
    }

    protected function deleteLabel($name, $scope)
    {
        $this->language->delete($scope, 'fields', $name);
        $this->language->delete($scope, 'options', $name);
        return $this->language->save();
    }

    protected function getFieldDefs($name, $scope)
    {
        return $this->metadata->get($this->metadataType.'.'.$scope.'.fields.'.$name);
    }

    protected function getLinkDefs($name, $scope)
    {
        return $this->metadata->get($this->metadataType.'.'.$scope.'.links.'.$name);
    }

    /**
     * Prepare input fieldDefs, remove unnecessary fields
     *
     * @param string $fieldName
     * @param array $fieldDefs
     * @param string $scope
     * @return array
     */
    protected function prepareFieldDefs($name, $fieldDefs, $scope)
    {
        $unnecessaryFields = array(
            'name',
            'label',
            'translatedOptions',
        );

        foreach ($unnecessaryFields as $fieldName) {
            if (isset($fieldDefs[$fieldName])) {
                unset($fieldDefs[$fieldName]);
            }
        }

        $currentOptionList = array_keys((array) $this->getFieldDefs($name, $scope));
        foreach ($fieldDefs as $defName => $defValue) {
            if ( (!isset($defValue) || $defValue === '') && !in_array($defName, $currentOptionList) ) {
                unset($fieldDefs[$defName]);
            }
        }

        return $fieldDefs;
    }

    /**
     * Add all needed block for a field defenition
     *
     * @param string $fieldName
     * @param array $fieldDefs
     * @param string $scope
     * @return array
     */
    protected function normalizeDefs($fieldName, array $fieldDefs, $scope)
    {
        $fieldDefs = $this->prepareFieldDefs($fieldName, $fieldDefs, $scope);

        $metaFieldDefs = $this->metadataHelper->getFieldDefsInFieldMeta($fieldDefs);
        if (isset($metaFieldDefs)) {
            $fieldDefs = Util::merge($metaFieldDefs, $fieldDefs);
        }

        if (isset($fieldDefs['linkDefs'])) {
            $linkDefs = $fieldDefs['linkDefs'];
            unset($fieldDefs['linkDefs']);
        }

        $defs = array(
            'fields' => array(
                $fieldName => $fieldDefs,
            ),
        );

        /** Save links for a field. */
        $metaLinkDefs = $this->metadataHelper->getLinkDefsInFieldMeta($scope, $fieldDefs);
        if (isset($linkDefs) || isset($metaLinkDefs)) {
            $linkDefs = Util::merge((array) $metaLinkDefs, (array) $linkDefs);
            $defs['links'] = array(
                $fieldName => $linkDefs,
            );
        }

        return $defs;
    }

    /**
     * Check if changed metadata defenition for a field except 'label'
     *
     * @return boolean
     */
    protected function isDefsChanged($name, $fieldDefs, $scope)
    {
        $fieldDefs = $this->prepareFieldDefs($name, $fieldDefs, $scope);
        $currentFieldDefs = $this->getFieldDefs($name, $scope);

        $this->isChanged = Util::isEquals($fieldDefs, $currentFieldDefs) ? false : true;

        return $this->isChanged;
    }

    /**
     * Only for update method
     *
     * @return boolean
     */
    public function isChanged()
    {
        return $this->isChanged;
    }

    /**
     * Check if a field is core field
     *
     * @param  string  $name
     * @param  string  $scope
     * @return boolean
     */
    protected function isCore($name, $scope)
    {
        $existingField = $this->getFieldDefs($name, $scope);
        if (isset($existingField) && (!isset($existingField[$this->customOptionName]) || !$existingField[$this->customOptionName])) {
            return true;
        }

        return false;
    }

    private function getAttributeListByType($scope, $name, $type)
    {
        $fieldType = $this->metadata->get('entityDefs.' . $scope . '.fields.' . $name . '.type');
        if (!$fieldType) return [];

        $defs = $this->metadata->get('fields.' . $fieldType);
        if (!$defs) return [];
        if (is_object($defs)) {
            $defs = get_object_vars($defs);
        }

        $fieldList = [];

        if (isset($defs[$type . 'Fields'])) {
            $list = $defs[$type . 'Fields'];
            $naming = 'suffix';
            if (isset($defs['naming'])) {
                $naming = $defs['naming'];
            }
            if ($naming == 'prefix') {
                foreach ($list as & $f) {
                    $fieldList[] = $f . ucfirst($name);
                }
            } else {
                foreach ($list as & $f) {
                    $fieldList[] = $name . ucfirst($f);
                }
            }
        } else {
            if ($type == 'actual') {
                $fieldList[] = $name;
            }
        }

        return $fieldList;
    }

    public function getActualAttributeList($scope, $name)
    {
        return $this->getAttributeListByType($scope, $name, 'actual');
    }

    public function getNotActualAttributeList($scope, $name)
    {
        return $this->getAttributeListByType($scope, $name, 'notActual');
    }

    public function getAttributeList($scope, $name)
    {
        return array_merge($this->getActualAttributeList($scope, $name), $this->getNotActualAttributeList($scope, $name));
    }
}
