<?php
namespace Fox\EntryPoints;

use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;
use \Fox\Core\Utils\Util;
use GuzzleHttp\json_encode;

/**
 * 
 *
 * @date   2017-2-17 上午11:44:16
 * @author jqh
 */
class Orders extends Base
{
    public static $authRequired = false;
    
    protected $rowNum = 15;
    
    // 卖流量订单状态
    protected $saleStatus = [
    	'all' => false,
        'wait' => 0,
        'finished' => 1,
        'success' => 6,
    ];
    
    public function handle()
    {
        switch (isset($_GET['type']) ? $_GET['type'] : '') {
        	case 'wait':
        	    $this->display('wait');
        	    break;
        	case 'finished':
        	    $this->display('finished');
        	    break;
        	case 'success':
        	    $this->display('success');
        	    break;
        	default:
        	    $this->display('all');
        }
        
    }
    
    // 接口
    protected function returnApi()
    {
        echo json_encode($this->getList(isset($_GET['type']) ? $_GET['type'] : 'all'));
    }
    
    protected function getList($type = 'all')
    {
        $page = ! empty($_GET['page']) ? $_GET['page'] : 1;
        
        // $t有值为买流量订单，否则为卖流量订单
        $t = ! empty($_GET['t']) ? $_GET['t'] : '';
        
        $id = '23213ddas';
        
        // 获取用户信息
        $user = $this->getUser();
        
        $id = $user['id'];
        
        $q = $this->getcontainer()->make('query');
        
        
        if ($t) {
            $f = [
            	'name',
                'created_at',
                'flow',
                'money',
                'flow_type',
                'flow_adress',
                'buyer_mobile',
                'status',
            ];
            
            $w = [''];
            
            $tb = 'buy_orders';
            
        } else {
            $f = [
                'name',
                'created_at',
                'flow',
                'money',
                'flow_type',
                'flow_adress',
                'buyer_mobile',
                'status',
            ];
            
            $w = ['seller_id' => $id, 'deleted' => 0];
            
            if ($type != 'all') {
                $w['status'] = $this->saleStatus[$type];
            }
            
            $tb = 'orders';
        }
        
        $r = $q->from($tb)
                ->where($w)
                ->count();
        
        $total = $r ? $r['TOTAL'] : 0;
        
        $offset = ($page - 1) * $this->rowNum;
        
        $r = [];
        if ($total) {
            $r = $q->from($tb)
                    ->select($f)
                    ->where($w)
                    ->sort('created_at', false)
                    ->limit($offset, $this->rowNum)
                    ->read();
        }
        
        return ['total' => $total, 'rows' => $r, 'type' => $type, 'rowNum' => $this->rowNum, 'page' => $page, 't' => $t];
    }
    
    protected function display($type = 'all')
    {
        $this->displayClient('wechat', 'orders', $this->getList($type));
    }
    
}
