<?php


namespace Fox\Modules\Crm\Repositories;

use Fox\ORM\Entity;

class Opportunity extends \Fox\Core\ORM\Repositories\RDB
{
    public function beforeSave(Entity $entity, array $options = array())
    {
        parent::beforeSave($entity, $options);

        if ($entity->isNew()) {
            if (!$entity->has('probability') && $entity->get('stage')) {
                $probability = $this->getMetadata()->get('entityDefs.Opportunity.probabilityMap.' . $entity->get('stage'), 0);
                $entity->set('probability', $probability);
            }
        }
    }
}

