<?php


namespace Fox\Controllers;

use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;

class Attachment extends \Fox\Core\Controllers\Record
{
    public function actionUpload($params, $data, $request)
    {
        if (!$request->isPost()) {
            throw new BadRequest();
        }

        if (!$this->getAcl()->checkScope('Attachment', 'create')) {
            throw new Forbidden();
        }

        list($prefix, $contents) = explode(',', $data);
        $contents = base64_decode($contents);

        $attachment = $this->getEntityManager()->getEntity('Attachment');
        $this->getEntityManager()->saveEntity($attachment);
        $this->getcontainer()->make('fileManager')->putContents('data/upload/' . $attachment->id, $contents);

        return array(
            'attachmentId' => $attachment->id
        );
    }

}

