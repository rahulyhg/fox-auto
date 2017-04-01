<?php
namespace Fox\Core\Controllers;

use \Fox\Core\Container;
use \Fox\Core\ServiceFactory;
use \Fox\Core\Utils\Util;

abstract class Base
{
    protected $name;

    protected $container;

    private $requestMethod;
    
    protected $config;
    
    protected $metadata;
    
    protected $user;
    
    protected $entityManager;

    public static $defaultAction = 'index';

    public function __construct(Container $container, $requestMethod = null, $name)
    {
        $this->container = $container;

        if (isset($requestMethod)) {
            $this->setRequestMethod($requestMethod);
        }
        
        $this->name = $name;
        
        $this->config = $this->container->make('config');
        $this->metadata = $this->container->make('metadata');
        $this->user = $this->container->make('user');
        $this->entityManager = $this->container->make('entityManager');

        $this->checkControllerAccess();
    }
    
    protected function checkControllerAccess()
    {
        return;
    }

    protected function getContainer()
    {
        return $this->container;
    }

    /**
     * Get request method name (Uppercase)
     *
     * @return string
     */
    protected function getRequestMethod()
    {
        return $this->requestMethod;
    }

    protected function setRequestMethod($requestMethod)
    {
        $this->requestMethod = strtoupper($requestMethod);
    }

    protected function getUser()
    {
        return $this->user;
    }

    protected function getAcl()
    {
        return $this->container->make('acl');
    }

    protected function getAclManager()
    {
        return $this->container->make('aclManager');
    }

    protected function getConfig()
    {
        return $this->config;
    }

    protected function getPreferences()
    {
        return $this->container->make('preferences');
    }

    protected function getMetadata()
    {
        return $this->metadata;
    }

    protected function getServiceFactory()
    {
        return $this->container->make('serviceFactory');
    }

    protected function getService($name = null)
    {
        return $this->getServiceFactory()->create($name ?: $this->name);
    }
}
