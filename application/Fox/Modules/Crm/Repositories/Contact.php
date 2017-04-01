<?php


namespace Fox\Modules\Crm\Repositories;

use Fox\ORM\Entity;

class Contact extends \Fox\Core\ORM\Repositories\RDB
{
    public function handleSelectParams(&$params)
    {
        parent::handleSelectParams($params);

        if (empty($params['customJoin'])) {
            $params['customJoin'] = '';
        }

        $params['customJoin'] .= "
            LEFT JOIN `account_contact` AS accountContact
            ON accountContact.contact_id = contact.id AND accountContact.account_id = contact.account_id AND accountContact.deleted = 0
        ";
    }

    public function afterSave(Entity $entity, array $options = array())
    {
        $result = parent::afterSave($entity, $options);
        $this->handleAfterSaveAccounts($entity, $options);

        if ($entity->has('targetListId')) {
            $this->relate($entity, 'targetLists', $entity->get('targetListId'));
        }

        return $result;
    }

    protected function handleAfterSaveAccounts(Entity $entity, array $options = array())
    {
        $accountIdChanged = $entity->has('accountId') && $entity->get('accountId') != $entity->getFetched('accountId');
        $titleChanged = $entity->has('title') && $entity->get('title') != $entity->getFetched('title');

        if ($accountIdChanged) {
            $accountId = $entity->get('accountId');
            if (empty($accountId)) {
                $this->unrelate($entity, 'accounts', $entity->getFetched('accountId'));
                return;
            }
        }

        if ($titleChanged) {
            if (empty($accountId)) {
                $accountId = $entity->getFetched('accountId');
                if (empty($accountId)) {
                    return;
                }
            }
        }

        if ($accountIdChanged || $titleChanged) {
            $pdo = $this->getEntityManager()->getPDO();

            $sql = "
                SELECT id, role FROM account_contact
                WHERE
                    account_id = ".$pdo->quote($accountId)." AND
                    contact_id = ".$pdo->quote($entity->id)." AND
                    deleted = 0
            ";
            $sth = $pdo->prepare($sql);
            $sth->execute();

            if ($row = $sth->fetch()) {
                if ($titleChanged && $entity->get('title') != $row['role']) {
                    $this->updateRelation($entity, 'accounts', $accountId, array(
                        'role' => $entity->get('title')
                    ));
                }
            } else {
                if ($accountIdChanged) {
                    $this->relate($entity, 'accounts', $accountId, array(
                        'role' => $entity->get('title')
                    ));
                }
            }
        }
    }
}

