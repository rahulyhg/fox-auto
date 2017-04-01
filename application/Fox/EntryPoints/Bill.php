<?php
namespace Fox\EntryPoints;

use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;
use \Fox\Core\Utils\Util;
use GuzzleHttp\json_encode;

/**
 * 账单
 *
 * @date   2017-2-21 下午1:49:26
 * @author jqh
 */
class Bill extends Base
{
    public static $authRequired = false;
    
    protected $rowNum = 3;
    
    public function handle()
    {
        if (isset($_GET['api'])) {
            return $this->returnApi();
        }
        
        $this->displayClient('wechat', 'bill', $this->getList());
    }
    
    // 接口
    protected function returnApi()
    {
        echo json_encode($this->getList());
    }
    
    protected function getList()
    {
        $page = ! empty($_GET['page']) ? $_GET['page'] : 1;
        
        $type = ! empty($_GET['type']) ? $_GET['type'] : 0;
        
        $id = '23213ddas';
        
        // 获取用户信息
        $user = $this->getUser();
        
        $id = $user['id'];
        
        $q = $this->q();
        
        $w = [
            'account_id' => $id, 'deleted' => 0
        ];
        
        if ($type) {
            $w['from'] = $type;
        }
        
        $total = $q->from('bill')->where($w)->count();
        
        $offset = ($page - 1) * $this->rowNum;
        
        $r = [];
        if ($total) {
            $r = $q->from('bill')
                   ->select(['created_at', 'money', 'from'])
                   ->where($w)
                   ->sort('created_at', true)
                   ->limit($offset, $this->rowNum)
                   ->read();
        }
        
        return ['total' => $total, 'rows' => $r, 'rowNum' => $this->rowNum, 'page' => $page];
    }
}
