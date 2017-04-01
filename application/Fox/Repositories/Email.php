<?php


namespace Fox\Repositories;

use Fox\ORM\Entity;

class Email extends \Fox\Core\ORM\Repositories\RDB
{
    protected function prepareAddressess(Entity $entity, $type, $addAssignedUser = false)
    {
        if (!$entity->has($type)) {
            return;
        }

        $eaRepositoty = $this->getEntityManager()->getRepository('EmailAddress');

        $address = $entity->get($type);
        $idList = [];
        if (!empty($address) || !filter_var($address, FILTER_VALIDATE_EMAIL)) {
            $arr = array_map(function ($e) {
                return trim($e);
            }, explode(';', $address));

            $idList = $eaRepositoty->getIdListFormAddressList($arr);
            foreach ($idList as $id) {
                $this->setUsersIdsByEmailAddressId($entity, $id, $addAssignedUser);
            }
        }
        $entity->setLinkMultipleIdList($type . 'EmailAddresses', $idList);
    }

    protected function setUsersIdsByEmailAddressId(Entity $entity, $emailAddressId, $addAssignedUser = false)
    {
        $user = $this->getEntityManager()->getRepository('EmailAddress')->getEntityByAddressId($emailAddressId, 'User');
        if ($user) {
            $entity->addLinkMultipleId('users', $user->id);
            if ($addAssignedUser) {
                $entity->addLinkMultipleId('assignedUsers', $user->id);
            }
        }
    }

    public function loadFromField(Entity $entity)
    {
        if ($entity->get('fromEmailAddressName')) {
            $entity->set('from', $entity->get('fromEmailAddressName'));
        }
    }

    public function loadNameHash(Entity $entity, array $fieldList = ['from', 'to', 'cc'])
    {
        $addressList = array();
        if (in_array('from', $fieldList) && $entity->get('from')) {
            $addressList[] = $entity->get('from');
        }

        if (in_array('to', $fieldList)) {
            $arr = explode(';', $entity->get('to'));
            foreach ($arr as $address) {
                if (!in_array($address, $addressList)) {
                    $addressList[] = $address;
                }
            }
        }

        if (in_array('cc', $fieldList)) {
            $arr = explode(';', $entity->get('cc'));
            foreach ($arr as $address) {
                if (!in_array($address, $addressList)) {
                    $addressList[] = $address;
                }
            }
        }

        $nameHash = (object) [];
        $typeHash = (object) [];
        $idHash = (object) [];
        foreach ($addressList as $address) {
            $p = $this->getEntityManager()->getRepository('EmailAddress')->getEntityByAddress($address);
            if ($p) {
                $nameHash->$address = $p->get('name');
                $typeHash->$address = $p->getEntityName();
                $idHash->$address = $p->id;
            }
        }

        $entity->set('nameHash', $nameHash);
        $entity->set('typeHash', $typeHash);
        $entity->set('idHash', $idHash);
    }

    protected function beforeSave(Entity $entity, array $options)
    {
        $eaRepositoty = $this->getEntityManager()->getRepository('EmailAddress');

        if ($entity->has('attachmentsIds')) {
            $attachmentsIds = $entity->get('attachmentsIds');
            if (!empty($attachmentsIds)) {
                $entity->set('hasAttachment', true);
            }
        }

        if ($entity->has('from') || $entity->has('to') || $entity->has('cc') || $entity->has('bcc') || $entity->has('replyTo')) {
            if (!$entity->has('usersIds')) {
                $entity->loadLinkMultipleField('users');
            }

            if ($entity->has('from')) {
                $from = trim($entity->get('from'));
                if (!empty($from)) {
                    $ids = $eaRepositoty->getIds(array($from));
                    if (!empty($ids)) {
                        $entity->set('fromEmailAddressId', $ids[0]);
                        $this->setUsersIdsByEmailAddressId($entity, $ids[0], true);
                    }
                } else {
                    $entity->set('fromEmailAddressId', null);
                }
            }

            if ($entity->has('to')) {
                $this->prepareAddressess($entity, 'to', true);
            }
            if ($entity->has('cc')) {
                $this->prepareAddressess($entity, 'cc');
            }
            if ($entity->has('bcc')) {
                $this->prepareAddressess($entity, 'bcc');
            }
            if ($entity->has('replyTo')) {
                $this->prepareAddressess($entity, 'replyTo');
            }

            $assignedUserId = $entity->get('assignedUserId');
            if ($assignedUserId) {
                $entity->addLinkMultipleId('users', $assignedUserId);
            }
        }

        parent::beforeSave($entity, $options);

        $parentId = $entity->get('parentId');
        $parentType = $entity->get('parentType');
        if (!empty($parentId) || !empty($parentType)) {
            $parent = $this->getEntityManager()->getEntity($parentType, $parentId);
            if (!empty($parent)) {
                if ($parent->getEntityType() == 'Account') {
                    $accountId = $parent->id;
                } else if ($parent->has('accountId')) {
                    $accountId = $parent->get('accountId');
                }
                if (!empty($accountId)) {
                    $account = $this->getEntityManager()->getEntity('Account', $accountId);
                    if ($account) {
                        $entity->set('accountId', $accountId);
                        $entity->set('accountName', $account->get('name'));
                    }
                }
            }
        }
    }

    protected function afterSave(Entity $entity, array $options)
    {
        parent::afterSave($entity, $options);
        if (!$entity->isNew()) {
            if ($entity->get('parentType') && $entity->get('parentId') && $entity->isFieldChanged('parentId')) {
                $replyList = $this->findRelated($entity, 'replies');
                foreach ($replyList as $reply) {
                    if ($reply->id === $entity->id) continue;
                    if (!$reply->get('parentId')) {
                        $reply->set(array(
                            'parentId' => $entity->get('parentId'),
                            'parentType' => $entity->get('parentType'),
                        ));
                        $this->getEntityManager()->saveEntity($reply);
                    }
                }
            }
        }
    }

}

