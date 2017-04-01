<?php
namespace Fox\Core;

use \Fox\Core\Exceptions\InternalServerError;

//加载器
class Loader 
{
	protected $container;
	
	/**
	 * 是否载入配置文件
	 * */
	protected $isLoadConfig;
	
	protected $config = 'data/container.php';
	
	/**
	 * 服务载入规则
	 * @key 服务别名
	 * @value ===> 
	 * 			   class string  类名
	 *	   		   dependencies array|string  依赖的服务 ===>
	 *									 	   服务别名1,  服务别名2 ...
	 * */
	protected $bindings = [//加载器加载信息（优先查找load*方法，找不到再从此数组信息中找）
            'container' => [
                'class' => '\Fox\Core\Container',
                'shared' => true,
            ],
	        'fileManager' => [
	             'class' => '\Fox\Core\Utils\File\Manager',
	             'shared' => true
	        ],
	        'entityManager' => [
	            'class' => '\Fox\Core\ORM\EntityManager',
	            'dependencies' => [
	            	'container', 'metadata', 'config'
	            ],
	            'shared' => true
	        ],
	        'unifier' => [
	            'class' => '\Fox\Core\Utils\File\Unifier',
	            'dependencies' => ['fileManager'],
	            'shared' => true
	        ],
	        'metadata' => [
	            'class' => '\Fox\Core\Utils\Metadata',
	            'dependencies' => ['config', 'fileManager'],
	            'shared' => true
	        ],
	        'hookManager' => [
	            'class' => '\Fox\Core\HookManager',
	            'dependencies' => 'container',
	            'shared' => true
	        ],
	        'output' => [
    	        'class' => '\Fox\Core\Utils\Api\Output',
    	        'dependencies' => 'slim',
    	        'shared' => true
	        ],
	        'slim' => [
	        	'class' => '\Fox\Core\Utils\Api\Slim',
	        	'shared' => true
	        ],
	        'mailSender' => [
    	        'class' => '\\Fox\\Core\\Mail\\Sender',
    	        'dependencies' => ['config', 'entityManager'],
    	        'shared' => true
	        ],
	        'dateTime' => [
    	        'class' => '\Fox\Core\Utils\DateTime',
    	        'shared' => true
	        ],
	        'number' => [
	            'class' => '\Fox\Core\Utils\Number',
    	        'shared' => true
	        ],
	        'serviceFactory' => [
    	        'class' => '\Fox\Core\ServiceFactory',
    	        'dependencies' => 'container',
    	        'shared' => true
	        ],
	        'layout' => [
    	        'class' => '\Fox\Core\Utils\Layout',
    	        'dependencies' => ['fileManager', 'metadata', 'user'],
    	        'shared' => true
	        ],
	        'aclManager' => [
	            'class' => '\\Fox\\Core\\AclManager',
	            'dependencies' => ['container'],
	            'shared' => true
	         ],
	         'metadataHelper' => [
    	         'class' => '\Fox\Core\Utils\Metadata\Helper',
    	         'dependencies' => ['metadata'],
    	         'shared' => true
	         ],
	         'acl' => [
	             'class' => '\\Fox\\Core\\Acl',
	             'dependencies' => ['aclManager', 'user'],
	             'shared' => true
	         ],
	         'schema' => [
	             'class' => '\Fox\Core\Utils\Database\Schema\Schema',
	             'dependencies' => ['config', 'metadata', 'fileManager', 'entityManager', 'classParser'],
	             'shared' => true
	         ],
	         'classParser' => [
    	         'class' => '\Fox\Core\Utils\File\ClassParser',
    	         'dependencies' => ['fileManager', 'config', 'metadata'],
    	         'shared' => true
	         ],
	         'language' => [
    	         'class' => '\Fox\Core\Utils\Language',
    	         'dependencies' => ['fileManager', 'config', 'metadata', 'unifier', 'preferences'],
    	         'shared' => true
	         ],
	         'acl' => [
	             'class' => '\\Fox\\Core\\Acl',
	             'dependencies' => ['aclManager', 'user'],
	             'shared' => true
	         ],
	         'crypt' => [
	             'class' => '\Fox\Core\Utils\Crypt',
	             'dependencies' => ['config'],
	             'shared' => true
	         ],
	         'scheduledJob' => [
	             'class' => '\Fox\Core\Utils\ScheduledJob',
	             'dependencies' => ['container'],
	             'shared' => true
             ],
             'dataManager' => [
                 'class' => '\Fox\Core\DataManager',
                 'dependencies' => ['container'],
                 'shared' => true
             ],
             'fieldManager' => [
                 'class' => '\Fox\Core\Utils\FieldManager',
                 'dependencies' => ['metadata', 'language'],
                 'shared' => true
             ],
             'themeManager' => [
                 'class' => '\Fox\Core\Utils\ThemeManager',
                 'dependencies' => ['config', 'metadata'],
                 'shared' => true
             ],
             'clientManager' => [
                 'class' => '\Fox\Core\Utils\ClientManager',
                 'dependencies' => ['config', 'themeManager'],
                 'shared' => true
             ],
	                 
	        'selectManagerFactory' => [
    	        'class' => '\Fox\Core\SelectManagerFactory',
    	        'dependencies' => ['entityManager', 'user', 'acl', 'metadata'],
    	        'shared' => true
	        ],
	        'output' => [
	            'class' => '\Fox\Core\Utils\Api\Output',
	            'dependencies' => 'slim',
	            'shared' => true
	            ],
            'config' => [
                'class' => '\Fox\Core\Utils\Config',
                'dependencies' => 'fileManager',
                'shared' => true
            ],
            'events' => [
                'class' => '\Fox\Core\Events\Dispatcher',
                'dependencies' => 'container',
                'shared' => true,
            ],
            'http.header' => [
                'class' => '\\Fox\Core\\Http\\Header',//类名
                'shared' => true,
            ],
            'http.response' => [
                'shared' => true,
                'class' => '\\Fox\Core\\Http\\Response',
                'dependencies' => 'http.header'//依赖的服务
            ],
            'http.request' => [
                'shared' => true,
                'class' => '\\Fox\Core\\Http\\Request',
                'dependencies' => 'http.header'
            ],
            'http.input' => [
                'shared' => true,
                'class' => '\\Fox\Core\\Http\\Input',
            ],
            'pdo' => [
                'shared' => true,
                'class' => 'Fox\ORM\Support\DB\PDO',
            ],
            'redis' => [
                'shared' => true,
                'class' => 'Fox\ORM\Support\DB\Redis',
            ],
            'query' => [
                'shared' => true,
                'class' => '\Fox\Core\ORM\Query',
                'dependencies' => ['builder.manager', 'container']	
        	],
            'router' => [
                'shared' => true,
                'class' => '\Fox\Core\Router\Dispatch',
                'dependencies' => 'container'	
            ],
            'controller.manager' => [
                'shared' => true,
                'class' => '\Fox\Core\Custom\ControllerManager',
                'dependencies' => 'container'	
            ],
            'file.manager' => [
                'shared' => true,
                'class' => '\Fox\Core\Utils\File\FileManager',
                'dependencies' => 'config'
            ],
            'http.client' => [
                'shared' => true,
                'class' => '\\Fox\Core\\Http\\Client'
            ],
            'pipeline.manager' => [
                'shared' => true,
                'class' => '\Fox\Core\Pipeline\PipelineManager',
                'dependencies' => 'container'	
            ],
            'passwordHash' => [
                'shared' => true,
                'class' => '\Fox\Core\Utils\PasswordHash',
                'dependencies' => 'config'
            ],
            'builder.manager' => [
                'shared' => true,
                'class' => '\Fox\Core\ORM\Builders\BuilderManager',
                'dependencies' => 'container'
        	],
//             'logger' => [
//                 'shared' => true,
//                 'class' => 'Fox\Core\Utils\Log',
//                 'dependencies' => 'container'
//             ],
            'model.factory' => [
                'shared' => true,
                'class' => '\Fox\Core\Custom\ModelFactory',
                'dependencies' => 'container'
            ],
            'cache.factory' => [
                'shared' => true,
                'class' => '\Fox\Core\Cache\CacheFactory',
                'dependencies' => 'container'
            ],
            'debug' => [
                'shared' => true,
                'class' => '\Fox\Core\Utils\Debug\Statistical',
                'dependencies' => 'container'
            ],
            'exception.handler' => [
                'shared' => true,
                'class' => '\Fox\Core\Exceptions\Handlers\Handler',
                'dependencies' => 'container'
            ],
            'events.robotCheck' => [
                'shared' => true,
                'class' => '\Fox\Core\Helpers\Events\Route\RobotCheck'
        	],
            'events.agentCheck' => [
                'shared' => true,
                'class' => '\Fox\Core\Helpers\Events\Route\AgentCheck'
            ],
            'validator' => [
                'shared' => true,
                'class' => '\Fox\Core\Helpers\Valitron\Validator'
            ],
        ];
	
	/**
	 * 载入服务实例并注册到服务容器上
	 * 
	 * @param $abstract string 载入类实例的别名
	 * @return instance
	 * */
    protected function load($abstract, $binding) 
    {
        if (empty($binding['class'])) {
	        return false;
        }
        
        $className = $binding['class'];///////////////////////////////////////////////////////////////////////
        
        $dependencies = isset($binding['dependencies']) ? (array) $binding['dependencies'] : [];
        
        switch (count($dependencies)) {
            case 0:
    	       return new $className();
            	
            case 1: 
    	       return new $className($this->getDependencyInstance($dependencies[0]));
            
            case 2:
            	return new $className(
                    $this->getDependencyInstance($dependencies[0]),
                    $this->getDependencyInstance($dependencies[1])
            	);
            
            case 3:
            	return new $className(
            		$this->getDependencyInstance($dependencies[0]),
            		$this->getDependencyInstance($dependencies[1]),
            		$this->getDependencyInstance($dependencies[2])
            	);
            	
            default:
    	       return $this->getServiceInstance($className, $dependencies);
        		
        }
    }
	
	
    /**
     * 获取依赖类实例
     * 
     * @param string $alias 别名
     * @return instance
     * */
    protected function getDependencyInstance($alias)
    {
        return $this->make($alias);
    }
    
    /**
     * 根据别名获取类名
     * 
     * @param string $alias
     * @return string
     * */
    protected function getDependencyClass($alias) 
    {
        $loadRules = $this->getAllBindings();
        if (! isset($loadRules[$alias])) {
	       throw new InternalServerError("Can't find dependent service \"{$alias}\"!");
        }
        	
        return $loadRules[$alias]['class'];
    }
    
    /**
     * 利用反射获取服务实例
     * @param $className string 要载入的类名
     * @param $params array $className类依赖的参数
     * */
    protected function getServiceInstance($className, array & $dependencies = []) 
    {
        $class = new \ReflectionClass($className);
        
        foreach ($dependencies as & $abstract) {
            $abstract = $this->getDependencyInstance($abstract);
        }
        
        return $class->newInstanceArgs($dependencies);
    }
	
	/**
	 * 获取注入详情
	 * */
    protected function getServiceBindings($abstract)
    {
        if (isset($this->bindings[$abstract])) {
        	return $this->bindings[$abstract];
        }
        
        $bindings = $this->getAllBindings();
        
        if (! isset($bindings[$abstract])) {
        	return false;
        }
        
        return $bindings[$abstract];
    }
	
    /**
     * 检查别名是否存在
     * 
     * @return bool
     * */
    public function loadAliasExists($alias)
    {
        $loadRules = $this->getAllBindings();
        return isset($loadRules[$alias]);
    }
    
    /**
     * 获取服务注册规则
     * */
    public function & getAllBindings() 
    {
        if (! $this->isLoadConfig) {
        	$this->bindings += (array) include __ROOT__ . '/' . $this->config;
        	$this->isLoadConfig = true;
        }
        return $this->bindings;
    }
	
}
