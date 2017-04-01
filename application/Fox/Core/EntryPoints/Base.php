<?php
namespace Fox\Core\EntryPoints;

use \Fox\Core\Container;
use \Fox\Core\EntryPointManager;
use \Fox\Core\Exceptions\Forbidden;

abstract class Base
{
    protected $container;
    
    protected $manager;
    
    protected $config;

    public static $authRequired = true;

    public static $notStrictAuth = false;

    protected function getContainer()
    {
        return $this->container;
    }

    protected function getUser()
    {
        return $this->container->make('user');
    }

    protected function getAcl()
    {
        return $this->container->make('acl');
    }

    protected function getEntityManager()
    {
        return $this->container->make('entityManager');
    }

    protected function getServiceFactory()
    {
        return $this->container->make('serviceFactory');
    }

    protected function getConfig()
    {
        return $this->config;
    }

    protected function getMetadata()
    {
        return $this->container->make('metadata');
    }

    protected function getDateTime()
    {
        return $this->container->make('dateTime');
    }

    protected function getNumber()
    {
        return $this->container->make('number');
    }

    protected function getFileManager()
    {
        return $this->container->make('fileManager');
    }

    protected function getLanguage()
    {
        return $this->container->make('language');
    }

    protected function getClientManager()
    {
        return $this->container->make('clientManager');
    }

    public function __construct(Container $container, EntryPointManager $manager)
    {
        $this->container = $container;
        $this->manager   = $manager;
        $this->config    = $this->container->make('config');
    }

}

