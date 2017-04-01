<?php


namespace Fox\Modules\Crm\Controllers;

use \Fox\Core\Exceptions\Error;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;

class Document extends \Fox\Core\Controllers\Record
{

    public function postActionGetAttachmentList($params, $data)
    {
        if (empty($data['id'])) {
            throw new BadRequest();
        }

        $id = $data['id'];

        if (!$this->getAcl()->checkScope('Attachment', 'create')) {
            throw new Forbidden();
        }

        return $this->getRecordService()->getAttachmentList($id)->toArray();
    }

}
