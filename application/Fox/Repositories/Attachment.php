<?php
namespace Fox\Repositories;

use Fox\ORM\Entity;

class Attachment extends \Fox\Core\ORM\Repositories\RDB
{
    protected function init()
    {
        $this->dependencies[] = 'fileManager';
    }

    protected function getFileManager()
    {
        return $this->getInjection('fileManager');
    }

    public function beforeSave(Entity $entity, array $options = array())
    {
        parent::beforeSave($entity, $options);
        if ($entity->isNew()) {
            if (!$entity->has('size') && $entity->has('contents')) {
                $entity->set('size', mb_strlen($entity->has('contents')));
            }
        }
    }

    public function save(Entity $entity, array $options = array())
    {
        $isNew = $entity->isNew();
        $result = parent::save($entity, $options);

        if ($isNew) {
            if (!empty($entity->id) && $entity->has('contents')) {
                $contents = $entity->get('contents');
                $this->getFileManager()->putContents($this->getFilePath($entity), $contents);
            }
        }

        return $result;
    }

    protected function afterRemove(Entity $entity, array $options = array())
    {
        parent::afterRemove($entity, $options);
        $this->getFileManager()->removeFile('data/upload/' . $entity->id);
    }

    public function getCopiedAttachment(Entity $entity, $role = null)
    {
        $attachment = $this->get();

        $attachment->set(array(
            'sourceId' => $entity->getSourceId(),
            'name' => $entity->get('name'),
            'type' => $entity->get('type'),
            'size' => $entity->get('size')
        ));

        if ($role) {
            $attachment->set('role', $role);
        }

        $this->save($attachment);

        return $attachment;
    }

    public function getContents(Entity $entity)
    {
        return $this->getFileManager()->getContents($this->getFilePath($entity));
    }

    public function getFilePath(Entity $entity)
    {
        $sourceId = $entity->getSourceId();

        return 'data/upload/' . $sourceId;
    }

}

