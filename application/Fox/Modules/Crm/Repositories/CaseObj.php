<?php


namespace Fox\Modules\Crm\Repositories;

use Fox\ORM\Entity;

class CaseObj extends \Fox\Core\ORM\Repositories\RDB
{
    public function afterSave(Entity $entity, array $options = array())
    {
        $result = parent::afterSave($entity, $options);
        $this->handleAfterSaveContacts($entity, $options);
        return $result;
    }

    protected function handleAfterSaveContacts(Entity $entity, array $options = array())
    {
        $contactIdChanged = $entity->has('contactId') && $entity->get('contactId') != $entity->getFetched('contactId');

        if ($contactIdChanged) {
            $contactId = $entity->get('contactId');
            if (empty($contactId)) {
                $this->unrelate($entity, 'contacts', $entity->getFetched('contactId'));
                return;
            }
        }

        if ($contactIdChanged) {
            $pdo = $this->getEntityManager()->getPDO();

            $sql = "
                SELECT id FROM case_contact
                WHERE
                    contact_id = ".$pdo->quote($contactId)." AND
                    case_id = ".$pdo->quote($entity->id)." AND
                    deleted = 0
            ";
            $sth = $pdo->prepare($sql);
            $sth->execute();

            if (!$sth->fetch()) {
                $this->relate($entity, 'contacts', $contactId);
            }
        }
    }

    protected function afterRelateArticles(Entity $entity, $foreign)
    {
        $foreignEntity = null;
        if ($foreign instanceof Entity) {
            $foreignEntity = $foreign;
        } else if (is_string($foreign)) {
            $foreignEntity = $this->getEntityManager()->getEntity('KnowledgeBaseArticle', $foreign);
        }
        if (!$foreignEntity) return;

        $n = $this->getEntityManager()->getRepository('Note')->where(array(
            'type' => 'Relate',
            'parentId' => $entity->id,
            'parentType' => 'Case',
            'relatedId' => $foreignEntity->id,
            'relatedType' => $foreignEntity->getEntityType()
        ))->findOne();
        if ($n) {
            return;
        }

        $note = $this->getEntityManager()->getEntity('Note');
        $note->set(array(
            'type' => 'Relate',
            'parentId' => $entity->id,
            'parentType' => 'Case',
            'relatedId' => $foreignEntity->id,
            'relatedType' => $foreignEntity->getEntityType()
        ));
        $this->getEntityManager()->saveEntity($note);
    }

    protected function afterUnrelateArticles(Entity $entity, $foreign)
    {
        $foreignEntity = null;
        if ($foreign instanceof Entity) {
            $foreignEntity = $foreign;
        } else if (is_string($foreign)) {
            $foreignEntity = $this->getEntityManager()->getEntity('KnowledgeBaseArticle', $foreign);
        }
        if (!$foreignEntity) return;

        $note = $this->getEntityManager()->getRepository('Note')->where(array(
            'type' => 'Relate',
            'parentId' => $entity->id,
            'parentType' => 'Case',
            'relatedId' => $foreignEntity->id,
            'relatedType' => $foreignEntity->getEntityType()
        ))->findOne();
        if (!$note) return;

        $this->getEntityManager()->removeEntity($note);
    }

}

