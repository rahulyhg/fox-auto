<?php
namespace Fox\Core\Services;

use \Fox\Core\Interfaces\Injectable;

abstract class Base implements Injectable
{
    protected $entityName;
    
    protected $entityType;
    
    protected $dependencies = array(
        'config',
        'entityManager',
        'user',
    );

    protected $injections = array();

    public function inject($name, $object)
    {
        $this->injections[$name] = $object;
    }

    public function __construct($name)
    {
        $this->entityName = $this->entityType = $name;
        
        $this->init();
    }

    protected function init()
    {
    }

    protected function getInjection($name)
    {
        return $this->injections[$name];
    }

    protected function addDependency($name)
    {
        $this->dependencies[] = $name;
    }

    public function getDependencyList()
    {
        return $this->dependencies;
    }

    protected function getEntityManager()
    {
        return $this->getInjection('entityManager');
    }

    protected function getConfig()
    {
        return $this->getInjection('config');
    }

    protected function getUser()
    {
        return $this->getInjection('user');
    }
}
