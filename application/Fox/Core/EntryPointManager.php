<?php
namespace Fox\Core;

use \Fox\Core\Exceptions\NotFound,
    \Fox\Core\Utils\Util;

class EntryPointManager
{
    private $container;

    protected $data = null;

    protected $cacheFile = 'data/cache/application/entryPoints.php';

    protected $allowedMethods = array(
        'handle',
    );

    /**
     * @var array - path to entryPoint files
     */
    private $paths = array(
        'corePath' => 'application/Fox/EntryPoints',
        'modulePath' => 'application/Fox/Modules/{*}/EntryPoints',
        'customPath' => 'custom/Fox/Custom/EntryPoints',
    );


    public function __construct(\Fox\Core\Container $container)
    {
        $this->container = $container;
    }

    public function checkAuthRequired($name)
    {
        $className = $this->getClassName($name);
        if (!$className) {
            throw new NotFound();
        }
        return $className::$authRequired;
    }

    public function checkNotStrictAuth($name)
    {
        $className = $this->getClassName($name);
        if (!$className) {
            throw new NotFound();
        }
        return $className::$notStrictAuth;
    }

    public function handle($name, $data = array())
    {
        if (! $className = $this->getClassName($name)) {
            throw new NotFound();
        }
        return (new $className($this->container, $this))->handle($data);
    }
    
    public function getEntryPointConcrete($name)
    {
        $className = $this->getClassName($name);
        return new $className($this->container, $this);
    }

    protected function getClassName($name)
    {
        $name = Util::normilizeClassName($name);

        if (!isset($this->data)) {
            $this->init();
        }

        $name = ucfirst($name);
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }

        return false;
    }


    protected function init()
    {
        $classParser = $this->container->make('classParser');
        $classParser->setAllowedMethods($this->allowedMethods);
        $this->data = $classParser->getData($this->paths, $this->cacheFile);
    }

}
