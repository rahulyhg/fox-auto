<?php


namespace Fox\Modules\Crm\Controllers;

use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;
use \Fox\Core\Exceptions\NotFound;

class Call extends \Fox\Core\Controllers\Record
{

    public function postActionSendInvitations($params, $data)
    {
        if (empty($data['id'])) {
            throw new BadRequest();
        }

        $entity = $this->getRecordService()->getEntity($data['id']);

        if (!$entity) {
            throw new NotFound();
        }

        if (!$this->getAcl()->check($entity, 'edit')) {
            throw new Forbidden();
        }

        if (!$this->getAcl()->checkScope('Email', 'create')) {
            throw new Forbidden();
        }

        return $this->getRecordService()->sendInvitations($entity);
    }

    public function postActionMassSetHeld($params, $data)
    {
        if (empty($data['ids']) && !is_array($data['ids'])) {
            throw new BadRequest();
        }

        return $this->getRecordService()->massSetHeld($data['ids']);
    }

    public function postActionMassSetNotHeld($params, $data)
    {
        if (empty($data['ids']) && !is_array($data['ids'])) {
            throw new BadRequest();
        }

        return $this->getRecordService()->massSetNotHeld($data['ids']);
    }

}
