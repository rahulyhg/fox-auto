<?php
namespace Fox\EntryPoints;

use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;
use \Fox\Core\Utils\Util;

/**
 * 提现界面
 *
 * @date   2017-2-17 上午11:44:16
 * @author jqh
 */
class Withdraw extends Base
{
    public static $authRequired = true;
    
    public function handle()
    {
        if (isset($_POST['cash'])) {
            // 提现
        	return $this->enchashment($_POST['cash']);
        }
        
        $this->display();
    }
    
    protected function display($msg = null)
    {
        $wechat = $this->getcontainer()->make('wechatAuth');
        // 获取用户信息
        $user = $wechat->getUser(['balances', 'blocked_balances']);
        
        $id = $user['id'];
        // 获取用户信息
        //         $users = $wechat->getUser(['balances', 'blocked_balances']);
        $q = $this->q();
        $user = $q->from('account')
                  ->select(['id', 'name', 'avatar', 'balances'])
                  ->where(['id' => $id, 'deleted' => 0])
                  ->readRow();
        
        $data = $q->from('encashment')
                  ->select(['created_at', 'status', 'money'])
                  ->where(['account_id' => $user['id'], 'deleted' => 0])
                  ->sort('created_at', false)
                  ->read();
        
        $user['rows'] = & $data;
        
        $user['msg'] = $msg;
        
        $this->displayClient('wechat', 'withdraw', $user);
    }
    
    // 提现
    protected function enchashment($money)
    {
        if ($money < 1) {
        	return $this->display('提现金额必须大于1元');
        }
        
        $id = '23213ddas';
        
        $wechat = $this->getcontainer()->make('wechatAuth');
        // 获取用户信息
        $user = $wechat->getUser(['balances', 'blocked_balances']);
        
        $id = $user['id'];
        
        // 转化为厘
        $m = $money * 1000;
        
        $q = $this->q();
        
        $user = $q->from('account')
                  ->select(['balances'])
                  ->where(['id' => $id, 'deleted' => 0])
                  ->readRow();
        
        if ($m > $user['balances']) {
        	return $this->display("您的可提现余额不足$money元！");
        }
        
        // 减用户金额
        $r = $q->from('account')->where(['id' => $id, 'deleted' => 0])->decr('balances', $m);
        if (! $r) {
            logger()->error("提现失败！", ['id' => $id, 'money' => $money]);
           
            return $this->display('提现失败，请联系网站管理人员！'); 
        }
        
        $d = date('Y-m-d H:i:s');
        
        $eid = Util::generateId();
        $r = $q->from('encashment')->insert([
            'id' => $eid,
            'money' => $m,
            'created_at' => $d,
            'account_id' => $id,
            'status' => 3,
            'finished_time' => $d,
        ]);
        
        if (! $r) {
            logger()->error("提现余额记录失败！", ['id' => $id, 'money' => $money]);
        }
        
        $this->display('恭喜您提现成功！');
    }
    
}
