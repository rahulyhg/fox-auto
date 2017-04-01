<?php
namespace Fox\Core;

use \Fox\Core\Utils\Util;
use \Fox\Core\Exceptions\NotFound;

class ControllerManager
{
    private $config;

    private $metadata;

    private $container;

    public function __construct(\Fox\Core\Container $container)
    {
        $this->container = $container;

        $this->config = $this->container->make('config');
        $this->metadata = $this->container->make('metadata');
    }

    public function process($controllerName, $actionName, $params, $data, $request)
    {
        $name = Util::normilizeClassName($controllerName);
//         debug($name);die;
//         $customeClassName = '\\Fox\\Custom\\Controllers\\' . $name;
//         if (class_exists($customeClassName)) {
//             $controllerClassName = $customeClassName;
//         } else {
        $moduleName = $this->metadata->getScopeModuleName($controllerName);
        if ($moduleName) {
            $controllerClassName = '\\Fox\\Modules\\' . $moduleName . '\\Controllers\\' . $name;
        } else {
            $controllerClassName = '\\Fox\\Controllers\\' . $name;
        }
//         }

        if (! class_exists($controllerClassName)) {
            throw new NotFound("Controller '$controllerName' is not found");
        }
        
        if ($data && stristr($request->getContentType(), 'application/json')) {
            $data = json_decode($data, true);
        }
        
        
        if ($data instanceof \stdClass) {
            $data = get_object_vars($data);
        }

        $controller = new $controllerClassName($this->container, $request->getMethod(), $name);
        if (! $actionName) {
            $actionName = $controllerClassName::$defaultAction;
        }
        
        $actionNameUcfirst = $actionName;

        $actionMethodName = 'action' . $actionNameUcfirst;

        $fullActionMethodName = $request->getMethod() . $actionMethodName;

        if (method_exists($controller, $fullActionMethodName)) {
            $primaryActionMethodName = $fullActionMethodName;
        } else {
            $primaryActionMethodName = $actionMethodName;
        }
        
        if (! method_exists($controller, $primaryActionMethodName)) {
            throw new NotFound("Action '$actionName' (".$request->getMethod().") does not exist in controller '$controllerName'");
        }
     
        $result = $controller->$primaryActionMethodName($params, $data, $request);

        if (is_array($result) || $result instanceof \StdClass) {
            return json_encode($result);
        }

        return $result;
    }

}
