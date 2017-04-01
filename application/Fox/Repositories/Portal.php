<?php


namespace Fox\Repositories;

use Fox\ORM\Entity;

use \Fox\Core\Exceptions\Error;

class Portal extends \Fox\Core\ORM\Repositories\RDB
{
    protected function init()
    {
        $this->addDependency('config');
    }

    protected function getConfig()
    {
        return $this->getInjection('config');
    }

    protected function afterSave(Entity $entity, array $options = array())
    {
        parent::afterSave($entity, $options);

        if ($entity->has('isDefault')) {
            if ($entity->get('isDefault')) {
                $this->getConfig()->set('defaultPortalId', $entity->id);
                $this->getConfig()->save();
            } else {
                if ($entity->isAttributeChanged('isDefault')) {
                    $this->getConfig()->set('defaultPortalId', null);
                    $this->getConfig()->save();
                }
            }
        }
    }
}

