<?php
namespace Fox\Core\Entities;

class CategoryTreeItem extends \Fox\Core\ORM\Entity
{
    public function toArray()
    {
        $data = parent::toArray();
        $childList = $this->get('childList');
        if (is_null($childList)) {
            $data['childList'] = null;
        } else {
            $arr = [];
            foreach ($childList as $entity) {
                $arr[] = $entity->toArray();
            }
            $data['childList'] = & $arr;
        }
        return $data;
    }
}
