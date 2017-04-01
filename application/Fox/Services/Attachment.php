<?php


namespace Fox\Services;

class Attachment extends Record
{
    protected $notFilteringAttributeList = ['contents'];

    public function createEntity($data)
    {
        if (!empty($data['file'])) {
            list($prefix, $contents) = explode(',', $data['file']);
            $contents = base64_decode($contents);
            $data['contents'] = $contents;
        }

        $entity = parent::createEntity($data);

        return $entity;
    }
}

