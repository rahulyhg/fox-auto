<?php
namespace Fox\Controllers;

use \Fox\Core\Exceptions\BadRequest;
use GuzzleHttp\json_encode;

class Wechat extends \Fox\Core\Controllers\Base
{
    public function actionTest()
    {
//         $q = $this->getcontainer()->make('query');
        //return $q->from('account')->read();
    }
    
    /**
     * 微信支付回调接口
     *
     * @date   2017-3-14 下午4:25:23
     * @author jqh
     * @return
     */
    public function actionWechatPay()
    {
        logger()->error('收到支付回调');
        
        $app = $this->getcontainer()->make('wechat');
        
        $payment = $app->payment;
        
        $response = $app->payment->handleNotify([$this, 'notifyHandler']);
        $response->send();
    }
    // 支付回调处理
    public function notifyHandler($notify, $successful) 
    {
        logger()->error("支付结果：$successful ===> " . json_encode($notify));
    }
    
    // 网页授权回调api
    public function actionOauthCallback()
    {
        $auth = $this->getcontainer()->make('wechatAuth');
        
        return $auth->redirectTarget();
    }
    
    // 添加微信菜单
    public function actionAddMenu()
    {
        $app  = $this->getcontainer()->make('wechat');
        $menu = $app->menu;
        
        // 先删除再新增
        $menu->destroy();
        
        $buttons = [
            [
                'type' => 'view',
                'name' => '流量转移',
                'url'  => 'http://wxapi.iflow800.cn/?entryPoint=Home'
            ],
            [
                'type' => 'view',
                'name' => '流量购买',
                'url'  => 'http://wxapi.iflow800.cn/?entryPoint=Buy'
            ],
            [
                'name'       => '管理',
                'sub_button' => [
                    [
                        'type' => 'view',
                        'name' => '个人中心',
                        'url'  => 'http://wxapi.iflow800.cn/?entryPoint=Person'
                        ],
                    [
                        'type' => 'view',
                        'name' => '我的订单',
                        'url'  => 'http://wxapi.iflow800.cn/?entryPoint=Orders'
                        ],
                    [
                        'type' => 'view',
                        'name' => '帮助',
                        'url' => 'http://wxapi.iflow800.cn/?entryPoint=Helps'
                    ],
                    [
                        'type' => 'view',
                        'name' => '我的二维码',
                        'url' => 'http://wxapi.iflow800.cn/?entryPoint=QR'
                    ],
                  ],
                ],
            ];
        return $menu->add($buttons);
    }
}
