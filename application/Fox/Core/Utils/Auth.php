<?php
namespace Fox\Core\Utils;

use \Fox\Core\Exceptions\Error;
use \Fox\Core\Exceptions\Forbidden;

use \Fox\Entities\Portal;

class Auth
{
    protected $container;

    protected $authentication;

    protected $allowAnyAccess;

    const ACCESS_CRM_ONLY = 0;

    const ACCESS_PORTAL_ONLY = 1;

    const ACCESS_ANY = 3;

    private $portal;
    
    protected $config;
    
    protected $entityManager;

    public function __construct(\Fox\Core\Container $container, $allowAnyAccess = false)
    {
        $this->container = $container;

        $this->allowAnyAccess = $allowAnyAccess;
        
        $this->config = $container->make('config');
        
        $this->entityManager = $container->make('entityManager');

        $authenticationMethod = $this->config->get('authenticationMethod', 'Fox');
        $authenticationClassName = "\\Fox\\Core\\Utils\\Authentication\\" . $authenticationMethod;
        $this->authentication = new $authenticationClassName($this->config, $this->entityManager, $this);

        $this->request = $container->make('slim')->request();
    }

    protected function setPortal(Portal $portal)
    {
        $this->portal = $portal;
    }

    protected function getPortal()
    {
        if ($this->portal) {
            return $this->portal;
        }
        return false;
        return $this->container->make('portal');
    }

    public function useNoAuth($isAdmin = false)
    {
        $entityManager = $this->container->make('entityManager');

        $user = $entityManager->getRepository('User')->get('system');
        if (!$user) {
            throw new Error("System user is not found");
        }

        $user->set('isAdmin', $isAdmin);

        $entityManager->setUser($user);
        $this->container->instance('user', $user);
    }

    public function login($username, $password)
    {
        $authToken = $this->entityManager->getRepository('AuthToken')->where(array('token' => $password))->findOne();

        $user = $this->authentication->login($username, $password, $authToken);

        if ($user) {
            if (!$user->isActive()) {
                logger()->debug("AUTH: Trying to login as user '".$user->get('userName')."' which is not active.");
                return false;
            }

            $this->entityManager->setUser($user);
            $this->container->set('user', $user);

            if ($this->request->headers->get('HTTP_FOX_AUTHORIZATION')) {
	            if (! $authToken) {
	                $authToken = $this->entityManager->getEntity('AuthToken');
	                $token = $this->createToken($user);
	                $authToken->set('token', $token);
	                $authToken->set('hash', $user->get('password'));
	                $authToken->set('ipAddress', $_SERVER['REMOTE_ADDR']);
	                $authToken->set('userId', $user->id);
	            }
            	$authToken->set('lastAccess', date('Y-m-d H:i:s'));

            	$this->entityManager->saveEntity($authToken);
            	$user->set('token', $authToken->get('token'));
            }

            return true;
        }
    }

    protected function createToken($user)
    {
        return md5(uniqid($user->get('id')));
    }

    public function destroyAuthToken($token)
    {
//         $authToken = $this->entityManager->getRepository('AuthToken')->where(array('token' => $token))->findOne();
//         if ($authToken) {
//             $this->entityManager->removeEntity($authToken);
//             return true;
//         }
        return Q()->from('auth_token')->where('token', $token)->remove();
    }
}

