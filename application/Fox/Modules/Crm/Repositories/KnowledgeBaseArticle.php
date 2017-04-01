<?php


namespace Fox\Modules\Crm\Repositories;

use Fox\ORM\Entity;

class KnowledgeBaseArticle extends \Fox\Core\ORM\Repositories\RDB
{

    protected function afterRelateCases(Entity $entity, $foreign)
    {
        $case = null;
        if ($foreign instanceof Entity) {
            $case = $foreign;
        } else if (is_string($foreign)) {
            $case = $this->getEntityManager()->getEntity('Case', $foreign);
        }
        if (!$case) return;

        $n = $this->getEntityManager()->getRepository('Note')->where(array(
            'type' => 'Relate',
            'parentId' => $case->id,
            'parentType' => 'Case',
            'relatedId' => $entity->id,
            'relatedType' => $entity->getEntityType()
        ))->findOne();
        if ($n) {
            return;
        }

        $note = $this->getEntityManager()->getEntity('Note');
        $note->set(array(
            'type' => 'Relate',
            'parentId' => $case->id,
            'parentType' => 'Case',
            'relatedId' => $entity->id,
            'relatedType' => $entity->getEntityType()
        ));
        $this->getEntityManager()->saveEntity($note);
    }

    protected function afterUnrelateCases(Entity $entity, $foreign)
    {
        $case = null;
        if ($foreign instanceof Entity) {
            $case = $foreign;
        } else if (is_string($foreign)) {
            $case = $this->getEntityManager()->getEntity('Case', $foreign);
        }
        if (!$case) return;

        $note = $this->getEntityManager()->getRepository('Note')->where(array(
            'type' => 'Relate',
            'parentId' => $case->id,
            'parentType' => 'Case',
            'relatedId' => $entity->id,
            'relatedType' => $entity->getEntityType()
        ))->findOne();
        if (!$note) return;

        $this->getEntityManager()->removeEntity($note);
    }
}
