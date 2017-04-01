<?php
namespace Fox\Core\Utils\Authentication;

use Fox\Core\Container;
use \EasyWeChat\Foundation\Application;
use Fox\Core\Utils\Util;
use GuzzleHttp\json_encode;

/**
 * 微信授权验证对象
 *
 * @date   2017-2-15 下午4:55:46
 * @author jqh
 */
class Wechat
{
    protected $container;
    
    /**
     * @var \EasyWeChat\Foundation\Application
     */
    protected $app;
    
    /**
     * 微信用户信息
     *
     * @var array
     */
    protected $user;
    
    /**
     * 要跳转的url
     *
     * @var string
     */
    public $targetUrl;
    
    /**
     * 默认跳转的url
     *
     * @var string
     */
    public $defaultUrl = '/?entryPoint=Person';
    
    /**
     * 默认登录缓存时间（单位秒）
     * 7天 
     *
     * @var int
     */
    public $defaultExpired = 604800;
    
    public function __construct(Container $container, Application $app)
    {
        $this->container = $container;
        $this->app       = $app;
        
        session_start();
        
//         $this->defaultUrl = $_SERVER['REQUEST_URI'];
    }
    
    // 获取微信用户信息
    public function getUser(array $others = [])
    {
        // 获取用户信息
        if ($this->user) {
            return $this->user;
        }
        // 用户未授权或授权已过期
        if (! $this->isLogin()) {
            return $this->redirect();
        }
        if (! empty(($user = $_SESSION['__USERS__']))) {
            return $this->user = $user;
        }
        
        $id = $_COOKIE['__user__'];
        if (! $id) {
            return $this->redirect();
        }
        
        $q = $this->container->make('query');
        
        $data = $q->from('account')
                  ->select(['id', 'name', 'avatar', 'open_id'])
                  ->where('id', $id)
                  ->readRow();
        
        if (! $data) {
            logger()->error('获取用户信息失败！id: ' . $id, ['file' => __FILE__]);
            return $this->redirect();
        }
        return $this->user = $data;
    }
    
    // 判断是否已授权
    public function isLogin()
    {
        return isset($_SESSION['__USERS__']) || isset($_COOKIE['__user__']);
    } 
    
    
    // 跳转到微信授权界面
    public function redirect()
    {
        $this->app
            ->oauth
//             ->scopes(['snsapi_userinfo'])
            ->redirect()
            ->send();
        
        exit;
    }
    
    // 微信授权回调成功后跳转到目标地址
    public function redirectTarget()
    {
        $this->saveUser();
        
        $u = ! empty($_SESSION['target_url']) ? $_SESSION['target_url'] : '/?entryPoint=Person';
        
        header('location:' . $u);
    }
    
    // 刷新登录信息
    public function reLogin($user)
    {
        unset($data['balances']);
        unset($data['blocked_balances']);
        $this->login($user);
    }
    
    // 授权回调后存储用户信息
    protected function saveUser()
    {
        $oauth = $this->app->oauth;
        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        
        $data = [
        	'open_id'    => $user->getId(),
            'name'       => $user->getNickname(),
            'avatar'     => $user->getAvatar(),
            'created_at' => date('Y-m-d H:i:s'),
            'mobile'     => 0,
            'full_name'  => '',
            'wechat_no'  => '',
            'zfb'        => ''
        ];
        
        $q = $this->container->make('query');
        
        $r = $q->from('account')->select('id')->where(['open_id' => $data['open_id'], 'deleted' => 0])->readRow();
        
        if (! $r) {
            // 如果不存在则写入数据库
            $data['id'] = Util::generateId();
            $q->from('account')->insert($data);
        } else {
            $data['id'] = $r['id'];
        }
        
        $this->login($data);
    }
    
    protected function login($data)
    {
        $c = $this->container->make('config');
        // 缓存cookie
        setcookie('__user__', $data['id'], time() + $c->get('wechat.auth_expired', $this->defaultExpired));
        // 缓存进session
        $_SESSION['__USERS__'] = $data;
        
        $this->user = $data;
    }
}
