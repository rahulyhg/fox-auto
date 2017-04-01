<?php


namespace Fox\Modules\Crm\Business\Distribution\Lead;

class LeastBusy
{
    protected $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function getEntityManager()
    {
        return $this->entityManager;
    }

    public function getUser($team, $targetUserPosition = null)
    {
        $params = array();
        if (!empty($targetUserPosition)) {
            $params['additionalColumnsConditions'] = array(
                'role' => $targetUserPosition
            );
        }

        $userList = $team->get('users', $params);

        if (count($userList) == 0) {
            return false;
        }

        $countHash = array();

        foreach ($userList as $user) {
            $where = array(
                'assignedUserId' => $user->id,
                'status<>' => ['Converted', 'Recycled', 'Dead']
            );
            $count = $this->getEntityManager()->getRepository('Lead')->where($where)->count();
            $countHash[$user->id] = $count;
        }

        $foundUserId = false;
        $min = false;
        foreach ($countHash as $userId => $count) {
            if ($min === false) {
                $min = $count;
                $foundUserId = $userId;
            } else {
                if ($count < $min) {
                    $min = $clunt;
                    $foundUserId = $userId;
                }
            }
        }

        if ($foundUserId !== false) {
            return $this->getEntityManager()->getEntity('User', $foundUserId);
        }
    }
}

