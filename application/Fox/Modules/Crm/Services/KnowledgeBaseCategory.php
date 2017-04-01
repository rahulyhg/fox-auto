<?php


namespace Fox\Modules\Crm\Services;

use \Fox\ORM\Entity;

class KnowledgeBaseCategory extends \Fox\Services\RecordTree
{
    protected function checkFilterOnlyNotEmpty()
    {
        if (!$this->getAcl()->checkScope('KnowledgeBaseArticle', 'create')) {
            return true;
        }
    }

    protected function checkItemIsEmpty(Entity $entity)
    {
        $selectManager = $this->getSelectManager('KnowledgeBaseArticle');

        $selectParams = $selectManager->getEmptySelectParams();
        $selectManager->applyInCategory('categories', $entity->id, $selectParams);
        $selectManager->applyAccess($selectParams);

        if ($this->getEntityManager()->getRepository('KnowledgeBaseArticle')->findOne($selectParams)) {
            return false;
        }
        return true;
    }
}

