<?php
namespace Fox\Core\Utils;

use \Fox\Core\Exceptions\Error;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\Conflict;
use \Fox\Core\Utils\Json;

class EntityManager
{
    private $metadata;

    private $language;

    private $fileManager;

    private $metadataHelper;

    public function __construct(Metadata $metadata, Language $language, File\Manager $fileManager)
    {
        $this->metadata = $metadata;
        $this->language = $language;
        $this->fileManager = $fileManager;
//         $this->metadataHelper = $metadata->getMetadataHelper();//new \Fox\Core\Utils\Metadata\Helper($this->metadata);
    }

    public function create($name, $type, $params = array())
    {
        if ($this->metadata->get('scopes.' . $name)) {
            throw new Conflict('Entity ['.$name.'] already exists.');
        }
        if (empty($name) || empty($type)) {
            throw new Error();
        }

        $normalizedName = Util::normilizeClassName($name);

        $contents = "<" . "?" . "php\n\n".
            "namespace Fox\Custom\Entities;\n\n".
            "class {$normalizedName} extends \Fox\Core\Templates\Entities\\{$type}\n".
            "{\n".
            "    protected \$entityType = \"$name\";\n".
            "}\n";

        $filePath = "custom/Fox/Custom/Entities/{$normalizedName}.php";
        $this->fileManager->putContents($filePath, $contents);

        $contents = "<" . "?" . "php\n\n".
            "namespace Fox\Custom\Controllers;\n\n".
            "class {$normalizedName} extends \Fox\Core\Templates\Controllers\\{$type}\n".
            "{\n".
            "}\n";
        $filePath = "custom/Fox/Custom/Controllers/{$normalizedName}.php";
        $this->fileManager->putContents($filePath, $contents);

        $contents = "<" . "?" . "php\n\n".
            "namespace Fox\Custom\Services;\n\n".
            "class {$normalizedName} extends \Fox\Core\Templates\Services\\{$type}\n".
            "{\n".
            "}\n";
        $filePath = "custom/Fox/Custom/Services/{$normalizedName}.php";
        $this->fileManager->putContents($filePath, $contents);

        $contents = "<" . "?" . "php\n\n".
            "namespace Fox\Custom\Repositories;\n\n".
            "class {$normalizedName} extends \Fox\Core\Templates\Repositories\\{$type}\n".
            "{\n".
            "}\n";

        $filePath = "custom/Fox/Custom/Repositories/{$normalizedName}.php";
        $this->fileManager->putContents($filePath, $contents);

        $stream = false;
        if (!empty($params['stream'])) {
            $stream = $params['stream'];
        }
        $disabled = false;
        if (!empty($params['disabled'])) {
            $disabled = $params['disabled'];
        }
        $labelSingular = $name;
        if (!empty($params['labelSingular'])) {
            $labelSingular = $params['labelSingular'];
        }
        $labelPlural = $name;
        if (!empty($params['labelPlural'])) {
            $labelPlural = $params['labelPlural'];
        }
        $labelCreate = $this->language->translate('Create') . ' ' . $labelSingular;

        $filePath = "application/Fox/Core/Templates/Metadata/{$type}/scopes.json";
        $scopesDataContents = $this->fileManager->getContents($filePath);
        $scopesDataContents = str_replace('{entityType}', $name, $scopesDataContents);
        $scopesData = json_decode($scopesDataContents, true);

        $scopesData['stream'] = $stream;
        $scopesData['disabled'] = $disabled;
        $scopesData['type'] = $type;
        $scopesData['module'] = 'Custom';
        $scopesData['object'] = true;
        $scopesData['isCustom'] = true;

        $this->metadata->set('scopes', $name, $scopesData);

        $filePath = "application/Fox/Core/Templates/Metadata/{$type}/entityDefs.json";
        $entityDefsDataContents = $this->fileManager->getContents($filePath);
        $entityDefsDataContents = str_replace('{entityType}', $name, $entityDefsDataContents);
        $entityDefsData = json_decode($entityDefsDataContents, true);
        $this->metadata->set('entityDefs', $name, $entityDefsData);

        $filePath = "application/Fox/Core/Templates/Metadata/{$type}/clientDefs.json";
        $clientDefsContents = $this->fileManager->getContents($filePath);
        $clientDefsContents = str_replace('{entityType}', $name, $clientDefsContents);
        $clientDefsData = json_decode($clientDefsContents, true);
        $this->metadata->set('clientDefs', $name, $clientDefsData);

        $this->language->set('Global', 'scopeNames', $name, $labelSingular);
        $this->language->set('Global', 'scopeNamesPlural', $name, $labelPlural);
        $this->language->set($name, 'labels', 'Create ' . $name, $labelCreate);

        $this->metadata->save();
        $this->language->save();

        $layoutsPath = "application/Fox/Core/Templates/Layouts/{$type}";
        if ($this->fileManager->isDir($layoutsPath)) {
            $this->fileManager->copy($layoutsPath, 'custom/Fox/Custom/Resources/layouts/' . $name);
        }

        return true;
    }

    public function update($name, $data)
    {
        if (!$this->metadata->get('scopes.' . $name)) {
            throw new Error('Entity ['.$name.'] does not exist.');
        }

        if (isset($data['stream']) || isset($data['disabled'])) {
            $scopeData = array();
            if (isset($data['stream'])) {
                $scopeData['stream'] = true == $data['stream'];
            }
            if (isset($data['disabled'])) {
                $scopeData['disabled'] = true == $data['disabled'];
            }
            $this->metadata->set('scopes', $name, $scopeData);
        }

        if (!empty($data['labelSingular'])) {
            $labelSingular = $data['labelSingular'];
            $this->language->set('Global', 'scopeNames', $name, $labelSingular);
            $labelCreate = $this->language->translate('Create') . ' ' . $labelSingular;
            $this->language->set($name, 'labels', 'Create ' . $name, $labelCreate);
        }

        if (!empty($data['labelPlural'])) {
            $labelPlural = $data['labelPlural'];
            $this->language->set('Global', 'scopeNamesPlural', $name, $labelPlural);
        }

        if (isset($data['sortBy'])) {
            $entityDefsData = array(
                'collection' => array(
                    'sortBy' => $data['sortBy'],
                    'asc' => !empty($data['asc'])
                )
            );
            $this->metadata->set('entityDefs', $name, $entityDefsData);
        }

        $this->metadata->save();
        $this->language->save();

        return true;
    }

    public function delete($name)
    {
        if (!$this->isCustom($name)) {
            throw new Forbidden;
        }

        $normalizedName = Util::normilizeClassName($name);

        $unsets = array(
            'entityDefs',
            'clientDefs',
            'scopes'
        );
        $res = $this->metadata->delete('entityDefs', $name);
        $res = $this->metadata->delete('clientDefs', $name);
        $res = $this->metadata->delete('scopes', $name);

        $this->fileManager->removeFile("custom/Fox/Custom/Resources/metadata/entityDefs/{$name}.json");
        $this->fileManager->removeFile("custom/Fox/Custom/Resources/metadata/clientDefs/{$name}.json");
        $this->fileManager->removeFile("custom/Fox/Custom/Resources/metadata/scopes/{$name}.json");

        $this->fileManager->removeFile("custom/Fox/Custom/Entities/{$normalizedName}.php");
        $this->fileManager->removeFile("custom/Fox/Custom/Services/{$normalizedName}.php");
        $this->fileManager->removeFile("custom/Fox/Custom/Controllers/{$normalizedName}.php");
        $this->fileManager->removeFile("custom/Fox/Custom/Repositories/{$normalizedName}.php");

        try {
            $this->language->delete('Global', 'scopeNames', $name);
            $this->language->delete('Global', 'scopeNamesPlural', $name);
        } catch (\Exception $e) {}

        $this->metadata->save();
        $this->language->save();

        return true;
    }

    protected function isCustom($name)
    {
        return $this->metadata->get('scopes.' . $name . '.isCustom');
    }

    public function createLink(array $params)
    {
        $linkType = $params['linkType'];

        $entity = $params['entity'];
        $link = $params['link'];
        $entityForeign = $params['entityForeign'];
        $linkForeign = $params['linkForeign'];

        $label = $params['label'];
        $labelForeign = $params['labelForeign'];

        if ($linkType === 'manyToMany') {
            if (!empty($params['relationName'])) {
                $relationName = $params['relationName'];
            } else {
                $relationName = lcfirst($entity) . $entityForeign;
            }
        }

        $linkMultipleField = false;
        if (!empty($params['linkMultipleField'])) {
            $linkMultipleField = true;
        }

        $linkMultipleFieldForeign = false;
        if (!empty($params['linkMultipleFieldForeign'])) {
            $linkMultipleFieldForeign = true;
        }

        if (empty($linkType)) {
            throw new Error();
        }
        if (empty($entity) || empty($entityForeign)) {
            throw new Error();
        }
        if (empty($entityForeign) || empty($linkForeign)) {
            throw new Error();
        }

        if ($this->metadata->get('entityDefs.' . $entity . '.links.' . $link)) {
            throw new Conflict('Link ['.$entity.'::'.$link.'] already exists.');
        }
        if ($this->metadata->get('entityDefs.' . $entityForeign . '.links.' . $linkForeign)) {
            throw new Conflict('Link ['.$entityForeign.'::'.$linkForeign.'] already exists.');
        }

        if ($entity === $entityForeign) {
            if ($link === ucfirst($entity) || $linkForeign === ucfirst($entity)) {
                throw new Conflict();
            }
        }

        switch ($linkType) {
            case 'oneToMany':
                if ($this->metadata->get('entityDefs.' . $entityForeign . '.field.' . $linkForeign)) {
                    throw new Conflict('Field ['.$entityForeign.'::'.$linkForeign.'] already exists.');
                }
                $dataLeft = array(
                    'fields' => array(
                        $link => array(
                            "type" => "linkMultiple",
                            "layoutDetailDisabled"  => !$linkMultipleField,
                            "layoutListDisabled"  => true,
                            "layoutMassUpdateDisabled"  => !$linkMultipleField,
                            "noLoad"  => !$linkMultipleField,
                            "importDisabled" => !$linkMultipleField,
                            'isCustom' => true
                        )
                    ),
                    'links' => array(
                        $link => array(
                            'type' => 'hasMany',
                            'foreign' => $linkForeign,
                            'entity' => $entityForeign,
                            'isCustom' => true
                        )
                    )
                );
                $dataRight = array(
                    'fields' => array(
                        $linkForeign => array(
                            'type' => 'link'
                        )
                    ),
                    'links' => array(
                        $linkForeign => array(
                            'type' => 'belongsTo',
                            'foreign' => $link,
                            'entity' => $entity,
                            'isCustom' => true
                        )
                    )
                );
                break;
            case 'manyToOne':
                if ($this->metadata->get('entityDefs.' . $entity . '.field.' . $link)) {
                    throw new Conflict('Field ['.$entity.'::'.$link.'] already exists.');
                }
                $dataLeft = array(
                    'fields' => array(
                        $link => array(
                            'type' => 'link'
                        )
                    ),
                    'links' => array(
                        $link => array(
                            'type' => 'belongsTo',
                            'foreign' => $linkForeign,
                            'entity' => $entityForeign,
                            'isCustom' => true
                        )
                    )
                );
                $dataRight = array(
                    'fields' => array(
                        $linkForeign => array(
                            "type" => "linkMultiple",
                            "layoutDetailDisabled"  => !$linkMultipleFieldForeign,
                            "layoutListDisabled"  => true,
                            "layoutMassUpdateDisabled"  => !$linkMultipleFieldForeign,
                            "noLoad"  => !$linkMultipleFieldForeign,
                            "importDisabled" => !$linkMultipleFieldForeign,
                            'isCustom' => true
                        )
                    ),
                    'links' => array(
                        $linkForeign => array(
                            'type' => 'hasMany',
                            'foreign' => $link,
                            'entity' => $entity,
                            'isCustom' => true
                        )
                    )
                );
                break;
            case 'manyToMany':
                $dataLeft = array(
                    'fields' => array(
                        $link => array(
                            "type" => "linkMultiple",
                            "layoutDetailDisabled"  => !$linkMultipleField,
                            "layoutListDisabled"  => true,
                            "layoutMassUpdateDisabled"  => !$linkMultipleField,
                            "importDisabled" => !$linkMultipleField,
                            "noLoad"  => !$linkMultipleField,
                            'isCustom' => true
                        )
                    ),
                    'links' => array(
                        $link => array(
                            'type' => 'hasMany',
                            'relationName' => $relationName,
                            'foreign' => $linkForeign,
                            'entity' => $entityForeign,
                            'isCustom' => true
                        )
                    )
                );
                $dataRight = array(
                    'fields' => array(
                        $linkForeign => array(
                            "type" => "linkMultiple",
                            "layoutDetailDisabled"  => !$linkMultipleFieldForeign,
                            "layoutListDisabled"  => true,
                            "layoutMassUpdateDisabled"  => !$linkMultipleFieldForeign,
                            "importDisabled" => !$linkMultipleFieldForeign,
                            "noLoad"  => !$linkMultipleFieldForeign,
                            'isCustom' => true
                        )
                    ),
                    'links' => array(
                        $linkForeign => array(
                            'type' => 'hasMany',
                            'relationName' => $relationName,
                            'foreign' => $link,
                            'entity' => $entity,
                            'isCustom' => true
                        )
                    )
                );
                if ($entityForeign == $entity) {
                    $dataLeft['links'][$link]['midKeys'] = ['leftId', 'rightId'];
                    $dataRight['links'][$linkForeign]['midKeys'] = ['rightId', 'leftId'];
                }
                break;
        }

        $this->metadata->set('entityDefs', $entity, $dataLeft);
        $this->metadata->set('entityDefs', $entityForeign, $dataRight);
        $this->metadata->save();

        $this->language->set($entity, 'fields', $link, $label);
        $this->language->set($entity, 'links', $link, $label);
        $this->language->set($entityForeign, 'fields', $linkForeign, $labelForeign);
        $this->language->set($entityForeign, 'links', $linkForeign, $labelForeign);

        $this->language->save();

        return true;
    }

    public function updateLink(array $params)
    {
        $entity = $params['entity'];
        $link = $params['link'];
        $entityForeign = $params['entityForeign'];
        $linkForeign = $params['linkForeign'];

        $label = $params['label'];
        $labelForeign = $params['labelForeign'];

        if (empty($entity) || empty($entityForeign)) {
            throw new Error();
        }
        if (empty($entityForeign) || empty($linkForeign)) {
            throw new Error();
        }

        if (
            $this->metadata->get("entityDefs.{$entity}.links.{$link}.type") == 'hasMany'
            &&
            $this->metadata->get("entityDefs.{$entity}.links.{$link}.isCustom")
        ) {
            if (array_key_exists('linkMultipleField', $params)) {
                $linkMultipleField = $params['linkMultipleField'];
                $dataLeft = array(
                    'fields' => array(
                        $link => array(
                            "type" => "linkMultiple",
                            "layoutDetailDisabled"  => !$linkMultipleField,
                            "layoutListDisabled"  => true,
                            "layoutMassUpdateDisabled"  => !$linkMultipleField,
                            "noLoad"  => !$linkMultipleField,
                            "importDisabled" => !$linkMultipleField,
                            'isCustom' => true
                        )
                    )
                );
                $this->metadata->set('entityDefs', $entity, $dataLeft);
                $this->metadata->save();
            }
        }

        if (
            $this->metadata->get("entityDefs.{$entityForeign}.links.{$linkForeign}.type") == 'hasMany'
            &&
            $this->metadata->get("entityDefs.{$entityForeign}.links.{$linkForeign}.isCustom")
        ) {
            if (isset($params['linkMultipleFieldForeign'])) {
                $linkMultipleFieldForeign = $params['linkMultipleFieldForeign'];
                $dataRight = array(
                    'fields' => array(
                        $linkForeign => array(
                            "type" => "linkMultiple",
                            "layoutDetailDisabled"  => !$linkMultipleFieldForeign,
                            "layoutListDisabled"  => true,
                            "layoutMassUpdateDisabled"  => !$linkMultipleFieldForeign,
                            "noLoad"  => !$linkMultipleFieldForeign,
                            "importDisabled" => !$linkMultipleFieldForeign,
                            'isCustom' => true
                        )
                    )
                );
                $this->metadata->set('entityDefs', $entityForeign, $dataRight);
                $this->metadata->save();
            }
        }

        $this->language->set($entity, 'fields', $link, $label);
        $this->language->set($entity, 'links', $link, $label);
        $this->language->set($entityForeign, 'fields', $linkForeign, $labelForeign);
        $this->language->set($entityForeign, 'links', $linkForeign, $labelForeign);

        $this->language->save();

        return true;
    }

    public function deleteLink(array $params)
    {
        $entity = $params['entity'];
        $link = $params['link'];

        if (!$this->metadata->get("entityDefs.{$entity}.links.{$link}.isCustom")) {
            throw new Error();
        }

        $entityForeign = $this->metadata->get("entityDefs.{$entity}.links.{$link}.entity");
        $linkForeign = $this->metadata->get("entityDefs.{$entity}.links.{$link}.foreign");

        if (empty($entity) || empty($entityForeign)) {
            throw new Error();
        }
        if (empty($entityForeign) || empty($linkForeign)) {
            throw new Error();
        }

        $this->metadata->delete('entityDefs', $entity, array(
            'fields.' . $link,
            'links.' . $link
        ));
        $this->metadata->delete('entityDefs', $entityForeign, array(
            'fields.' . $linkForeign,
            'links.' . $linkForeign
        ));
        $this->metadata->save();

        return true;
    }
}
