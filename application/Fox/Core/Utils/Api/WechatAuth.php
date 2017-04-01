<?php
namespace Fox\Core\Utils\Api;

use \Fox\Core\Utils\Api\Slim;
use Fox\Core\Utils\Authentication\Wechat;

class WechatAuth extends \Slim\Middleware
{
    protected $auth;
    
    public function __construct(Wechat $auth)
    {
        $this->auth = $auth;
    }
    
    function call()
    {
        if (! $this->auth->isLogin()) {
            $_SESSION['target_url'] = $_SERVER['REQUEST_URI'];
            
            // 跳转到微信授权登录界面
            return $this->auth->redirect();
        }
        
        // 已授权，继续执行
        $this->next->call();
    }
}
