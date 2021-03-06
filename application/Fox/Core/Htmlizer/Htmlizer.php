<?php
namespace Fox\Core\Htmlizer;

use Fox\ORM\Entity;
use Fox\Core\Exceptions\Error;

use Fox\Core\Utils\File\Manager as FileManager;
use Fox\Core\Utils\DateTime;
use Fox\Core\Utils\Number;

require('vendor/zordius/lightncandy/src/lightncandy.php');

class Htmlizer
{
    protected $fileManager;

    protected $dateTime;

    protected $config;

    public function __construct(FileManager $fileManager, DateTime $dateTime, Number $number)
    {
        $this->fileManager = $fileManager;
        $this->dateTime = $dateTime;
        $this->number = $number;
    }

    protected function formatNumber($value)
    {
        return $this->number->format($value);
    }

    protected function format($value)
    {
        if (is_float($value) || is_int($value)) {
            $value = $this->formatNumber($value);
        } else if (is_string($value)) {
            $value = nl2br($value);
        }
        return $value;
    }

    protected function getDataFromEntity(Entity $entity)
    {
        $data = $entity->toArray();



        $fieldDefs = $entity->getFields();
        $fieldList = array_keys($fieldDefs);

        foreach ($fieldList as $field) {
            $type = null;
            if (!empty($fieldDefs[$field]['type'])) {
                $type = $fieldDefs[$field]['type'];
            }
            if ($type == Entity::DATETIME) {
                if (!empty($data[$field])) {
                    $data[$field] = $this->dateTime->convertSystemDateTime($data[$field]);
                }
            } else if ($type == Entity::DATE) {
                if (!empty($data[$field])) {
                    $data[$field] = $this->dateTime->convertSystemDate($data[$field]);
                }
            } else if ($type == Entity::JSON_ARRAY) {
                if (!empty($data[$field])) {
                    $list = $data[$field];
                    $newList = [];
                    foreach ($list as $item) {
                        $v = $item;
                        if ($item instanceof \StdClass) {
                            $v = get_object_vars($v);
                        }
                        foreach ($v as $k => $w) {
                            $v[$k] = $this->format($v[$k]);
                        }
                        $newList[] = $v;
                    }
                    $data[$field] = $newList;
                }
            } else if ($type == Entity::JSON_OBJECT) {
                if (!empty($data[$field])) {
                    $value = $data[$field];
                    if ($value instanceof \StdClass) {
                        $data[$field] = get_object_vars($value);
                    }
                    foreach ($data[$field] as $k => $w) {
                        $data[$field][$k] = $this->format($data[$field][$k]);
                    }
                }
            }

            if (array_key_exists($field, $data)) {
               $data[$field] = $this->format($data[$field]);
            }
        }

        return $data;
    }

    public function render(Entity $entity, $template)
    {
        $code = \LightnCandy::compile($template);
        $id = uniqid('', true);
        $fileName = 'data/cache/template-' . $id;
        $this->fileManager->putContents($fileName, $code);
        $renderer = include($fileName);
        $this->fileManager->removeFile($fileName);

        $data = $this->getDataFromEntity($entity);

        $html = $renderer($data);

        $html = str_replace('?entryPoint=attachment&amp;', '?entryPoint=attachment&', $html);
        $html = preg_replace('/\?entryPoint=attachment\&id=(.*)/', 'data/upload/$1', $html);

        return $html;
    }
}
