<?php
namespace Fox\EntryPoints;

use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;
use \Fox\Core\Utils\Util;
use GuzzleHttp\json_encode;

/**
 * 我的粉丝
 *
 * @date   2017-2-17 上午11:44:16
 * @author jqh
 */
class Fans extends Base
{
    public static $authRequired = false;
    
    protected $rowNum = 3;

    public function handle()
    {
        return $this->displayClient('wechat', 'fans', $this->getList());
    }
    
    protected function returnApi()
    {
        echo json_encode($this->getList());
    }
    
    protected function getList()
    {
        $page = ! empty($_GET['page']) ? $_GET['page'] : 1;
        
//         $id = '23213ddas';
        
        $wechat = $this->getcontainer()->make('wechatAuth');
        // 获取用户信息
        $user = $wechat->getUser();
        
        $id = $user['id'];
        
        $q = $this->q();
        
        $w = [
            'parent_id' => $id, 'deleted' => 0
        ];
        
        $total = $q->from('account')->where($w)->count();
        
        $offset = ($page - 1) * $this->rowNum;
        
        $r = [];
        if ($total) {
            $r = $q->from('account')
                    ->select(['name', 'avatar'])
                    ->where($w)
                    ->sort('created_at', true)
                    ->limit($offset, $this->rowNum)
                    ->read();
        }
//         print_r($r);die;
        return ['total' => $total, 'rows' => $r, 'rowNum' => $this->rowNum, 'page' => $page];
    }
}
