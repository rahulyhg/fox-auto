<?php


namespace Fox\Modules\Crm\Services;

use \Fox\ORM\Entity;

class CaseObj extends \Fox\Services\Record
{
    protected $mergeLinkList = [
        'tasks',
        'meetings',
        'calls',
        'emails'
    ];

    protected $readOnlyAttributeList = [
        'inboundEmailId'
    ];

    public function afterCreate($entity, array $data = array())
    {
        parent::afterCreate($entity, $data);
        if (!empty($data['emailId'])) {
            $email = $this->getEntityManager()->getEntity('Email', $data['emailId']);
            if ($email && !$email->get('parentId')) {
                $email->set(array(
                    'parentType' => 'Case',
                    'parentId' => $entity->id
                ));
                $this->getEntityManager()->saveEntity($email);
            }
        }
    }

}

