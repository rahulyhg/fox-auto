<?php


namespace Fox\Modules\Crm\Services;

use \Fox\ORM\Entity;
use \Fox\Core\Exceptions\NotFound;

class Document extends \Fox\Services\Record
{
    public function getAttachmentList($id)
    {
        $entity = $this->getEntity($id);

        if (!$entity) {
            throw new NotFound();
        }

        $fileId = $entity->get('fileId');
        if (!$fileId) {
            throw new NotFound();
        }

        $file = $this->getEntityManager()->getEntity('Attachment', $fileId);
        if (!$file) {
            throw new NotFound();
        }

        $attachment = $this->getEntityManager()->getRepository('Attachment')->getCopiedAttachment($file, 'Attachment');

        $attachmentList = $this->getEntityManager()->createCollection('Attachment');
        $attachmentList[] = $attachment;

        return $attachmentList;
    }
}

