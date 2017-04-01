<?php
namespace Fox\ORM;

use Fox\Core\Container;
use \Fox\Core\HookManager;
use \Fox\Core\Utils\Metadata as EspoMetadata;
use \Fox\Core\Utils\Config;
use \Fox\Core\Utils\Util;

class EntityManager
{
    public $pdo;

    protected $entityFactory;

    protected $repositoryFactory;
    
    protected $espoMetadata;
    
    protected $hookManager;
    
    protected $user;
    
    protected $container;
    
    private $repositoryClassNameHash = array();
    
    private $entityClassNameHash = array();

    protected $mappers = array();

    protected $metadata;

    protected $repositoryHash = array();

    protected $params = array();

    protected $query;

    protected $driverPlatformMap = array(
        'pdo_mysql' => 'Mysql',
        'mysqli' => 'Mysql',
    );

    public function __construct(Container $container, EspoMetadata $metadata, Config $config)
    {
        $this->container = $container;
        
        $this->espoMetadata = $metadata;
        
        $this->params = $config->get('database');
        
        $this->params['metadata'] = $metadata->getOrmMetadata();
        
        $this->params['repositoryFactoryClassName'] = '\\Fox\\Core\\ORM\\RepositoryFactory';

        $this->metadata = new Metadata();

        if (empty($this->params['platform'])) {
            if (empty($this->params['driver'])) {
                throw new \Exception('No database driver specified.');
            }
            $driver = $this->params['driver'];
            if (empty($this->driverPlatformMap[$driver])) {
                throw new \Exception("Database driver '{$driver}' is not supported.");
            }
            $this->params['platform'] = $this->driverPlatformMap[$this->params['driver']];
        }

        if (! empty($this->params['metadata'])) {
            $this->setMetadata($this->params['metadata']);
        }

        $entityFactoryClassName = '\\Fox\\ORM\\EntityFactory';
        if (! empty($this->params['entityFactoryClassName'])) {
            $entityFactoryClassName = $this->params['entityFactoryClassName'];
        }
        $this->entityFactory = new $entityFactoryClassName($this, $this->metadata);

        $repositoryFactoryClassName = '\\Fox\\ORM\\RepositoryFactory';
        if (! empty($this->params['repositoryFactoryClassName'])) {
            $repositoryFactoryClassName = $this->params['repositoryFactoryClassName'];
        }
        $this->repositoryFactory = new $repositoryFactoryClassName($this, $this->entityFactory);

        $this->init();
    }

    public function getQuery()
    {
        if (empty($this->query)) {
            $platform = $this->params['platform'];
            $className = '\\Fox\\ORM\\DB\\Query\\' . ucfirst($platform);
            $this->query = new $className($this->getPDO(), $this->entityFactory);
        }
        return $this->query;
    }

    protected function getMapperClassName($name)
    {
        $className = null;

        switch ($name) {
            case 'RDB':
                $platform = $this->params['platform'];
                $className = '\\Fox\\ORM\\DB\\' . ucfirst($platform) . 'Mapper';
                break;
        }

        return $className;
    }

    public function getMapper($name)
    {
        if ($name{0} == '\\') {
            $className = $name;
        } else {
            $className = $this->getMapperClassName($name);
        }

        if (empty($this->mappers[$className])) {
            $this->mappers[$className] = new $className($this->getPDO(), $this->entityFactory, $this->getQuery());
        }
        return $this->mappers[$className];
    }

    protected function initPDO()
    {
        $params = $this->params;

        $port = empty($params['port']) ? '' : 'port=' . $params['port'] . ';';

        $platform = strtolower($params['platform']);

        $this->pdo = new \PDO($platform . ':host='.$params['host'].';'.$port.'dbname=' . $params['dbname'] . ';charset=utf8', $params['user'], $params['password']);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getEntity($name, $id = null)
    {
        return $this->getRepository($name)->get($id);
    }

    public function saveEntity(Entity $entity, array $options = array())
    {
        $entityName = $entity->getEntityName();
        return $this->getRepository($entityName)->save($entity, $options);
    }

    public function removeEntity(Entity $entity, array $options = array())
    {
        $entityName = $entity->getEntityName();
        return $this->getRepository($entityName)->remove($entity, $options);
    }

    public function getRepository($name)
    {
        if (empty($this->repositoryHash[$name])) {
            $this->repositoryHash[$name] = $this->repositoryFactory->create($name);
        }
        return $this->repositoryHash[$name];
    }

    public function setMetadata(array & $data)
    {
        $this->metadata->setData($data);
    }

    public function getMetadata()
    {
        return $this->metadata;
    }

    public function getPDO()
    {
        if (empty($this->pdo)) {
            $this->initPDO();
        }
        return $this->pdo;
    }

    public function getContainer()
    {
        return $this->container;
    }
    
    public function setUser($user)
    {
        $this->user = $user;
    }
    
    public function getUser()
    {
        return $this->user;
    }
    
    public function getFoxMetadata()
    {
        return $this->espoMetadata;
    }
    
    public function normalizeRepositoryName($name)
    {
        if (empty($this->repositoryClassNameHash[$name])) {
            $className = '\\Fox\\Custom\\Repositories\\' . Util::normilizeClassName($name);
            if (!class_exists($className)) {
                $className = $this->espoMetadata->getRepositoryPath($name);
            }
            $this->repositoryClassNameHash[$name] = $className;
        }
        return $this->repositoryClassNameHash[$name];
    }
    
    public function normalizeEntityName($name)
    {
        if (empty($this->entityClassNameHash[$name])) {
            $className = '\\Fox\\Custom\\Entities\\' . Util::normilizeClassName($name);
            if (!class_exists($className)) {
                $className = $this->espoMetadata->getEntityPath($name);
            }
            $this->entityClassNameHash[$name] = $className;
        }
        return $this->entityClassNameHash[$name];
    }

    public function createCollection($entityName, $data = array())
    {
        $seed = $this->getEntity($entityName);
        $collection = new EntityCollection($data, $seed, $this->entityFactory);
        return $collection;
    }

    protected function init()
    {
    }
}
