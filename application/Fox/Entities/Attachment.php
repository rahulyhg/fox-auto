<?php


namespace Fox\Entities;

class Attachment extends \Fox\Core\ORM\Entity
{
    public function getSourceId()
    {
        $sourceId = $this->get('sourceId');
        if (!$sourceId) {
            $sourceId = $this->id;
        }
        return $sourceId;
    }

}
