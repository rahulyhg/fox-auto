<?php
namespace Fox\Core;

use \Fox\Core\Exceptions\Error;

use \Fox\Core\Utils\Util;

class ServiceFactory
{
    private $container;
    
    protected $defaultName = 'Fox\Services\Record';

    protected $cacheFile = 'data/cache/application/services.php';

    /**
     * @var array - path to Service files
     */
    protected $paths = array(
        'corePath' => 'application/Fox/Services',
        'modulePath' => 'application/Fox/Modules/{*}/Services',
        'customPath' => 'custom/Fox/Custom/Services',
    );

    protected $data;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function init()
    {
        $classParser = $this->container->make('classParser');
        $classParser->setAllowedMethods(null);
        $this->data = $classParser->getData($this->paths, $this->cacheFile);
    }

    protected function getClassName($name)
    {
        if (!isset($this->data)) {
            $this->init();
        }

        if (isset($this->data[$name])) {
            return $this->data[$name];
        }

        return $this->defaultName;
    }

    public function checkExists($name) {
        $className = $this->getClassName($name);
        if (!empty($className)) {
            return true;
        }
    }

    public function create($name)
    {
        $className = $this->getClassName($name);
        if (empty($className)) {
            throw new Error();
        }
        return $this->createByClassName($className, $name);
    }

    protected function createByClassName($className, $name)
    {
        if (class_exists($className)) {
            $service = new $className($name);
            $dependencies = $service->getDependencyList();
            foreach ($dependencies as & $name) {
                $service->inject($name, $this->container->make($name));
            }
            return $service;
        }
        throw new Error("Class '$className' does not exist");
    }
}
