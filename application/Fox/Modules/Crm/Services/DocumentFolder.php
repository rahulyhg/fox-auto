<?php


namespace Fox\Modules\Crm\Services;

use \Fox\ORM\Entity;

class DocumentFolder extends \Fox\Services\RecordTree
{

    protected function checkFilterOnlyNotEmpty()
    {
        if (!$this->getAcl()->checkScope('Document', 'create')) {
            return true;
        }
    }

    protected function checkItemIsEmpty(Entity $entity)
    {
        $selectManager = $this->getSelectManager('Document');

        $selectParams = $selectManager->getEmptySelectParams();
        $selectManager->applyInCategory('folder', $entity->id, $selectParams);
        $selectManager->applyAccess($selectParams);

        if ($this->getEntityManager()->getRepository('Document')->findOne($selectParams)) {
            return false;
        }
        return true;
    }
}

