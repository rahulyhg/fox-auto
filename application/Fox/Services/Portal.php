<?php


namespace Fox\Services;

use \Fox\ORM\Entity;

class Portal extends Record
{
    protected $getEntityBeforeUpdate = true;

    public function loadAdditionalFields(Entity $entity)
    {
        parent::loadAdditionalFields($entity);
        $this->loadUrlField($entity);
    }

    public function loadAdditionalFieldsForList(Entity $entity)
    {
        parent::loadAdditionalFieldsForList($entity);
        $this->loadUrlField($entity);
    }

    protected function loadUrlField(Entity $entity)
    {
        $siteUrl = $this->getConfig()->get('siteUrl');
        $siteUrl = rtrim($siteUrl , '/') . '/';
        $url = $siteUrl . 'portal';
        if ($entity->id === $this->getConfig()->get('defaultPortalId')) {
            $entity->set('isDefault', true);
            $entity->setFetched('isDefault', true);
        } else {
            $url .= '?id=' . $entity->id;
            $entity->setFetched('isDefault', false);
        }
        $entity->set('url', $url);
    }
}

