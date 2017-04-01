<?php
namespace Fox\ORM\Support\Builders;

use Fox\Core\Container;

class BuilderManager
{
    protected $container;
    
    protected $instances;
    
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    
	protected $defaultName = 'SQLJ';
	/**
	 * 创建一个映射器
	 * */
	public function create($name = null) 
	{
	    $name = $name ?: $this->defaultName;
	    
		$class = '\\Fox\\ORM\\Support\\Builders\\' . $name . '\\Builder';

		return new $class($this->container);
	}
	
	public function get($name = null)
	{
	   $name = $name ?: $this->defaultName;
	   
	   if (isset($this->instances[$name])) {
	       return $this->instances[$name];
	   }
	   
	   return $this->instances[$name] = $this->create($name);
	}
}
