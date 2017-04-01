<?php
namespace Fox\Core;

use Fox\Core\Utils\Util;

class Application
{
    public $container;

    private $auth;

    public function __construct()
    {
        $this->container = Container::getInstance();
        date_default_timezone_set('PRC');
    }
    
    public function handle($api = false)
    {
        if ($api) {
            $this->routeHooks();
            $this->initRoutes();
            return $this->getSlim()->run();
        }

        if (! empty($_GET['entryPoint'])) {
            return $this->runEntryPoint($_GET['entryPoint']);
        }
        
        $this->container->make('clientManager')->display();
    }

    public function getSlim()
    {
        return $this->container->make('slim');
    }

    public function getMetadata()
    {
        return $this->container->make('metadata');
    }

    protected function createAuth()
    {
        return new \Fox\Core\Utils\Auth($this->container);
    }

    public function runEntryPoint($entryPoint, $data = array(), $final = false)
    {
        $slim = $this->getSlim();
        $container = $this->container;

        $slim->any('.*', function() {});

        $entryPointManager = new \Fox\Core\EntryPointManager($container);

        try {
            $authRequired = $entryPointManager->checkAuthRequired($entryPoint);
            $authNotStrict = $entryPointManager->checkNotStrictAuth($entryPoint);
            if ($authRequired && !$authNotStrict) {
                if (!$final && $portalId = $this->detectedPortalId()) {
                    $app = new \Fox\Core\Portal\Application($portalId);
                    $app->setBasePath($this->getBasePath());
                    return $app->runEntryPoint($entryPoint, $data, true);
                }
            }
//             $auth = new \Fox\Core\Utils\Auth($this->container, $authNotStrict);
//             $apiAuth = new \Fox\Core\Utils\Api\Auth($auth, $authRequired, true);
            if ($authRequired) {
                $authMiddleware = new \Fox\Core\Utils\Api\WechatAuth(
                    $this->container->make('wechatAuth')
                ); 
                $slim->add($authMiddleware);
            }

            $slim->hook('slim.before.dispatch', function () use ($entryPoint, $entryPointManager, $container, $data) {
                $entryPointManager->handle($entryPoint, $data);
            });

            $slim->run();
        } catch (\Exception $e) {
            $container->make('output')->processError($e->getMessage(), $e->getCode(), true);
        }
    }

    public function runCron()
    {
        $auth = $this->createAuth();
        $auth->useNoAuth(true);

        $cronManager = new \Fox\Core\CronManager($this->container);
        $cronManager->run();
    }

    public function runRebuild()
    {
        $dataManager = $this->container->make('dataManager');
        $dataManager->rebuild();
    }

    public function runClearCache()
    {
        $dataManager = $this->container->make('dataManager');
        $dataManager->clearCache();
    }

    public function isInstalled()
    {
        $config = $this->container->make('config');

        if (is_file($config->getConfigPath()) && $config->get('isInstalled')) {
            return true;
        }

        return false;
    }

    protected function createApiAuth($auth)
    {
        return new \Fox\Core\Utils\Api\Auth($auth);
    }

    protected function routeHooks()
    {
        $container = $this->container;
        $slim = $this->getSlim();

        try {
            $auth = $this->createAuth();
        } catch (\Exception $e) {
            $container->make('output')->processError($e->getMessage(), $e->getCode());
        }

        $apiAuth = $this->createApiAuth($auth);

        $this->getSlim()->add($apiAuth);
        $this->getSlim()->hook('slim.before.dispatch', function () use ($slim, $container) {

            $route = $slim->router()->getCurrentRoute();
            $conditions = $route->getConditions();

            if (isset($conditions['useController']) && $conditions['useController'] == false) {
                return;
            }

            $routeOptions = call_user_func($route->getCallable());
            $routeKeys = is_array($routeOptions) ? array_keys($routeOptions) : array();

            if (!in_array('controller', $routeKeys, true)) {
                return $container->make('output')->render($routeOptions);
            }

            $params = $route->getParams();
            $data = $slim->request()->getBody();

            foreach ($routeOptions as $key => & $value) {
                if (strstr($value, ':')) {
                    $paramName = str_replace(':', '', $value);
                    $value = $params[$paramName];
                }
                $controllerParams[$key] = $value;
            }

            $params = array_merge($params, $controllerParams);

            $controllerName = ucfirst($controllerParams['controller']);

            if (!empty($controllerParams['action'])) {
                $actionName = $controllerParams['action'];
            } else {
                $httpMethod = strtolower($slim->request()->getMethod());
                $crudList = $container->make('config')->get('crud');
                $actionName = $crudList[$httpMethod];
            }

            try {
                $controllerManager = new \Fox\Core\ControllerManager($container);
                $result = $controllerManager->process($controllerName, $actionName, $params, $data, $slim->request());
                $container->make('output')->render($result);
            } catch (\Exception $e) {
                $container->make('output')->processError($e->getMessage(), $e->getCode());
            }
        });

        $slim->hook('slim.after.router', function () use ($slim) {
            $slim->contentType('application/json');

            $res = $slim->response();
            $res->header('Expires', '0');
            $res->header('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT');
            $res->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            $res->header('Pragma', 'no-cache');
        });
    }

    protected function getRouteList()
    {
        return (new \Fox\Core\Utils\Route())->getAll();
    }

    protected function initRoutes()
    {
        $slim = $this->getSlim();
        
        foreach ($this->getRouteList() as & $route) {
            $methods = Util::getValueByKey($route, 'method', 'get');
            
            foreach (explode(',', $methods) as & $method) {
                if ($method == '*') {
                    $method = 'any';
                }
                
                $currentRoute = $slim->$method($route['route'], function() use ($route) {   //todo change "use" for php 5.4
                    return $route['params'];
                });
            }

            if (isset($route['conditions'])) {
                $currentRoute->conditions($route['conditions']);
            }
        }
    }

    public function setBasePath($basePath)
    {
        $this->container->make('clientManager')->setBasePath($basePath);
    }

    public function getBasePath()
    {
        return $this->container->make('clientManager')->getBasePath();
    }

    public function detectedPortalId()
    {
        if (!empty($_GET['portalId'])) {
            return $_GET['portalId'];
        }
        if (!empty($_COOKIE['auth-token'])) {
            $token = $this->container->make('entityManager')->getRepository('AuthToken')->where(array('token'=>$_COOKIE['auth-token']))->findOne();

            if ($token && $token->get('portalId')) {
                return $token->get('portalId');
            }
        }
        return null;
    }

}
