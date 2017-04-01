<?php
namespace Fox\EntryPoints;

use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;

class Person extends Base
{
    public static $authRequired = true;
    
    public function handle()
    {
//         $id = '23213ddas';
        
        $wechat = $this->getcontainer()->make('wechatAuth');
        // 获取用户信息
        $user = $wechat->getUser();
        
        $id     = $user['id'];
        $openId = $user['open_id'];
        
        $q = $this->q();
        $user = $q->from('account')
                    ->select(['id', 'name', 'avatar', 'balances', 'blocked_balances'])
                    ->where(['id' => $id])
                    ->readRow();
        
        if (! $user) {
            $user = $q->from('account')
                      ->select(['id', 'name', 'avatar', 'balances', 'blocked_balances'])
                      ->where(['open_id' => $openId])
                      ->readRow();
            if ($user) {
                // 重新登录
                $wechat->reLogin($user);
            } else {
                // 重新授权
                return $wechat->redirect();
            }
        }
        
        // 待支付
        $res1 = $q->from('orders')->where(['seller_id' => $user['id'], 'status' => 0, 'deleted' => 0])->count();
        // 已处理
        $res2 = $q->from('orders')->where(['seller_id' => $user['id'], 'status' => 1, 'deleted' => 0])->count();
        // 已完成
        $res3 = $q->from('orders')
                    ->where(
                        [
                            'seller_id' => $user['id'], 'status' => 1, 'deleted' => 0, 'audit_status' => 1
                        ]
                    )
                    ->count();
        
        $data = [
        	'wait'     => $res1,
            'handled'  => $res2,
            'finished' => $res3
        ];
        
        $this->displayClient('wechat', 'person', $user + $data);
    }
}
