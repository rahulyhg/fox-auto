<?php
namespace Fox\Core\Jobs;

use \Fox\Core\Container;

abstract class Base
{
    private $container;

    protected function getContainer()
    {
        return $this->container;
    }

    protected function getEntityManager()
    {
        return $this->getcontainer()->make('entityManager');
    }

    protected function getServiceFactory()
    {
        return $this->getcontainer()->make('serviceFactory');
    }

    protected function getConfig()
    {
        return $this->getcontainer()->make('config');
    }

    protected function getMetadata()
    {
        return $this->getcontainer()->make('metadata');
    }

    protected function getUser()
    {
        return $this->getcontainer()->make('user');
    }

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    abstract public function run();

}

