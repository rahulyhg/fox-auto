<?php


namespace Fox\Jobs;

use \Fox\Core\Exceptions;

class AuthTokenControl extends \Fox\Core\Jobs\Base
{
    public function run()
    {
        $authTokenLifetime = $this->getConfig()->get('authTokenLifetime');
        $authTokenMaxIdleTime = $this->getConfig()->get('authTokenMaxIdleTime');

        if (!$authTokenLifetime && !$authTokenMaxIdleTime) {
            return;
        }

        $whereClause = array();

        if ($authTokenLifetime) {
            $dt = new \DateTime();
            $dt->modify('-' . $authTokenLifetime . ' hours');
            $authTokenLifetimeThreshold = $dt->format('Y-m-d H:i:s');

            $whereClause['createdAt<'] = $authTokenLifetimeThreshold;
        }

        if ($authTokenMaxIdleTime) {
            $dt = new \DateTime();
            $dt->modify('-' . $authTokenMaxIdleTime . ' hours');
            $authTokenMaxIdleTimeThreshold = $dt->format('Y-m-d H:i:s');

            $whereClause['lastAccess<'] = $authTokenMaxIdleTimeThreshold;
        }

        $tokenList = $this->getEntityManager()->getRepository('AuthToken')->where($whereClause)->limit(0, 100)->find();

        foreach ($tokenList as $token) {
            $this->getEntityManager()->removeEntity($token);
        }
    }
}

