<?php
namespace Fox\EntryPoints;

use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;

class QR extends Base
{
    public static $authRequired = false;
    
    // 二维码缓存30天
    protected $e = 2592000;

    public function handle()
    {
        $wechat = $this->getcontainer()->make('wechatAuth');

        // 获取用户信息
        $user = $wechat->getUser();
        
        $id     = $user['id'];
        $openId = $user['open_id'];
        
        $q = $this->getcontainer()->make('query');
        
        $res = $q->from('account_ext')
                 ->select(['qr_created_at'])
                 ->where('id', $id)
                 ->readRow();
        
        $make = false;
                
        if (! $res) {
            // 第一次需要生成二维码
            $make = true;
        } else {
            $n = date('Y-m-d H:i:s', time() - $this->e);
            // 判断二维码是否在有效期内
            if ($res['qr_created_at'] <= $n) {
                $make = true;
            }
            
        }
        
        if ($make) {
            $this->makeQR($q, $id);
        }
//         echo "<img src='http://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQHP8DwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAyRWN0d04xTEFkdjQxUXBDdnhvMTUAAgQZ2bdYAwQAjScA'>";die;
        
        $this->displayClient('wechat', 'qr', ['qr' => "/client/img/qr/$id.jpg"]);
    }
    
    protected function makeSceneId()
    {
        return (microtime(true) . mt_rand(0, 99999)) * 10000;
    }
    
    protected function makeQR($q, $id)
    {
        // 有效期30天
        $e = $this->e;
        
        $sceneId = $this->makeSceneId();
        
        $app    = $this->getcontainer()->make('wechat');
        $qrcode = $app->qrcode;
        
        // 创建临时二维码
        $result = $qrcode->temporary($sceneId, $e);
        $ticket = $result->ticket;
        // 二维码地址
//         $url    = $result->url;
        
        $q->from('account_ext')
          ->replace(
              [
              	  'id'            => $id,
                  'qr_ticket'     => $ticket,
                  'scene_id'      => $sceneId,
                  'qr_created_at' => date('Y-m-d H:i:s'),
                  'qr_url'        => ''
              ]
         );
        
        $file = __ROOT__ . '/client/img/qr/' . $id . '.jpg';
        
        file_put_contents(
            $file, 
            file_get_contents("http://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=$ticket")
        );
        
        return true;
    }
}
