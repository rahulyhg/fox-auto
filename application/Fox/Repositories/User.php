<?php
namespace Fox\Repositories;

use \Fox\ORM\Entity;

use \Fox\Core\Exceptions\Error;

class User extends \Fox\Core\ORM\Repositories\RDB
{
    protected function beforeSave(Entity $entity, array $options = array())
    {
        parent::beforeSave($entity, $options);

        if ($entity->isNew()) {
            $userName = $entity->get('userName');
            if (empty($userName)) {
                throw new Error();
            }

            $user = $this->where(array(
                'userName' => $userName
            ))->findOne();

            if ($user) {
                throw new Error();
            }
        } else {
            if ($entity->isFieldChanged('userName')) {
                $userName = $entity->get('userName');
                if (empty($userName)) {
                    throw new Error();
                }

                $user = $this->where(array(
                    'userName' => $userName,
                    'id!=' => $entity->id
                ))->findOne();
                if ($user) {
                    throw new Error();
                }
            }
        }

        if ($entity->has('isAdmin') && $entity->get('isAdmin')) {
            $entity->set('isPortalUser', false);
            $entity->set('portalRolesIds', []);
            $entity->set('portalRolesNames', (object)[]);
            $entity->set('portalsIds', []);
            $entity->set('portalsNames', (object)[]);
        }

        if ($entity->has('isPortalUser') && $entity->get('isPortalUser')) {
            $entity->set('isAdmin', false);
            $entity->set('rolesIds', []);
            $entity->set('rolesNames', (object)[]);
            $entity->set('teamsIds', []);
            $entity->set('teamsNames', (object)[]);
            $entity->set('defaultTeamId', null);
            $entity->set('defaultTeamName', null);
        }
    }

    public function checkBelongsToAnyOfTeams($userId, array $teamIds)
    {
        if (empty($teamIds)) {
            return false;
        }

        $pdo = $this->getEntityManager()->getPDO();

        $arr = [];
        foreach ($teamIds as $teamId) {
            $arr[] = $pdo->quote($teamId);
        }

        $sql = "SELECT * FROM team_user WHERE deleted = 0 AND user_id = :userId AND team_id IN (".implode(", ", $arr).")";

        $sth = $pdo->prepare($sql);
        $sth->execute(array(
            ':userId' => $userId
        ));
        if ($row = $sth->fetch()) {
            return true;
        }
        return false;
    }
}

