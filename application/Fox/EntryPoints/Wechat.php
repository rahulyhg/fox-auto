<?php
namespace Fox\EntryPoints;

use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;
use \Fox\Core\Utils\Util;
use GuzzleHttp\json_encode;

/**
 * 提现界面
 *
 * @date   2017-2-17 上午11:44:16
 * @author jqh
 */
class Wechat extends \Fox\Core\EntryPoints\Base
{
    public static $authRequired = false;
    
    public function handle()
    {
        $app  = $this->getcontainer()->make('wechat');
        $serv = $app->server;
        
        $serv->setMessageHandler([$this, 'messageHandle']);
        
        $resp = $serv->serve();
        
        // 将响应输出
        $resp->send();
    }
    
    public function messageHandle($message)
    {
        // 注意，这里的 $message 不仅仅是用户发来的消息，也可能是事件
        // 当 $message->MsgType 为 event 时为事件
        if ($message->MsgType == 'event') {
            # code...
            switch ($message->Event) {
            	case 'subscribe':
            	    # code...
            	    $this->subscribe($message);
            	    break;
            	default:
            	    # code...
            	    break;
            }
        }
    }
    
    // 用户关注事件
    public function subscribe($msg)
    {
        // 不存在EventKey，普通关注
        // 存在EventKey，推广关注
        if (! $msg->EventKey) {
            return;
        }
        
        $q = $this->getcontainer()->make('query');
        $r = $q->from('account_ext')->select('id')->where('qr_ticket', $msg->Ticket)->readRow();
        
        if (! $r) {
            return logger()->error('粉丝推广获取父级ID失败。' . $msg->FromUserName);
        }
        
        $parentId = $r['id'];
        
        $r = $q->from('account')->select('id')->where(['open_id' => $msg->FromUserName, 'deleted' => 0])->readRow();
        if ($r) {
            // 用户已注册
            $this->beFans($r['id'], $parentId, $q);
            return;
        }
        
        
        $app  = $this->getcontainer()->make('wechat');
        $userService = $app->user;

        // 获取威信用户信息
        $user = $userService->get($msg->FromUserName);
        
        $data = [
            'open_id'    => $user->openid,
            'name'       => $user->nickname,
            'avatar'     => $user->headimgurl,
            'created_at' => date('Y-m-d H:i:s'),
            'mobile'     => 0,
            'full_name'  => '',
            'wechat_no'  => '',
            'zfb'        => ''
        ];
        
        // 如果不存在则写入数据库
        $data['id'] = Util::generateId();
        $q->from('account')->insert($data);
        
        $this->beFans($data['id'], $parentId, $q);
    }
    
    protected function beFans($id, $parentId, $q)
    {
        $q->from('account')->where('id', $id)->update(['parent_id' => $parentId]);
    }
}
