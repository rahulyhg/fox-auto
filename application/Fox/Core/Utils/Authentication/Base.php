<?php
namespace Fox\Core\Utils\Authentication;

use \Fox\Core\Utils\Config;
use \Fox\Core\ORM\EntityManager;
use \Fox\Core\Utils\Auth;

abstract class Base
{
    protected $config;

    protected $entityManager;

    protected $auth;

    protected $passwordHash;

    public function __construct(Config $config, EntityManager $entityManager, Auth $auth)
    {
        $this->config = $config;
        $this->entityManager = $entityManager;
        $this->auth = $auth;
    }

    protected function getConfig()
    {
        return $this->config;
    }

    protected function getEntityManager()
    {
        return $this->entityManager;
    }

    protected function getAuth()
    {
        return $this->auth;
    }

    protected function getPasswordHash()
    {
        return app('passwordHash');
    }
}
