<?php
namespace Fox\EntryPoints;

use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;
use \Fox\Core\Utils\Util;
use GuzzleHttp\json_decode;
use EasyWeChat\Payment\Order;
use GuzzleHttp\json_encode;

/**
 * 购买流量订单界面
 *
 * @date   2017-3-6 下午3:02:42
 * @author jqh
 */
class Buy extends Base
{
    public static $authRequired = false;
    
    public function handle()
    {
        if (! empty($_GET['a'])) {
            return $this->dispatch($_GET['a']);
        }
        
//         $app = $this->container->make('wechat');
//         // jsApiParameters
//         $payment = $app->payment;
        
//         $user = $this->getUser();
        
//         $attributes = [
//             'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
//             'body'             => '支付555',
//             'detail'           => '支iii试bbb',
//             'out_trade_no'     => '6687752501201407033233368018',
//             'total_fee'        => 1, // 单位：分
//             'notify_url'       => 'http://wxapi.iflow800.cn/api/v1/WechatPay', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
//             'openid'           => $user['open_id'], // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
//             // ...
//             ];
//         $order = new Order($attributes);
        
//         $result = $payment->prepare($order);
        
        $config = [];
        
        logger()->error('order result ===> ' . json_encode($result));
        
//         if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
//             $prepayId = $result->prepay_id;
//             $config = $payment->configForPayment($prepayId, false);
//             logger()->error('jsApiParameters config ===> ' . json_encode($result));
//         }
        
        return $this->displayClient('wechat', 'buy', [
            'rows' => $this->getList(),
            'jsApiParameters' => $config
        ]);
    }
    
    protected function getList()
    {
        $q = $this->q();
        // any_value(
        return $q->from('set_meal')
                ->select(
                    [
                	   'id id', 'flow', 'selling_price', 'area_id', 'type'
                    ]
                )
                ->where(
                    [
                        'deleted' => 0, 'status' => 1,
                    ]
                )
                ->sort('audit_at', false)
                ->group(
                    ['flow', 'area_id', 'type']
                )
                ->read();
    }
    
    // 下单
    protected function actionOrdering()
    {
        $data = file_get_contents('php://input');
        if (empty($data)) {
            echo json_encode(['status' => 0, 'msg' => '参数错误']);
            return false;
        }
        
        $data = json_decode($data, true);
        if (! is_array($data)) {
            echo json_encode(['status' => 0, 'msg' => '参数错误']);
            return false;
        }
        
        //{"province":20,"company":3,"price":"11000","selectedAreaId":100,"setMealId":"58be6ce8db0000e87"}
        $id     = $data['setMealId'];// 套餐包id
        $type   = $data['company'];// 运营商类型
        $flow   = $data['flow'];// 流量包大小
        $areaId = $data['selectedAreaId'];// 区域id
        $money  = $data['price'];// 价格
        $mobile = $data['mobile'];
        
        $user   = $this->getUser();
        
        $uid = $user['id'];
//         $uid = '23213ddas';
        
        $log = logger();
        
        $q = $this->q();
        
        $res = $q->from('buy_orders')
                ->insert(
                	[
                	    'id'  => Util::generateId(),
                	    'flow' => $flow,
                	    'created_at' => date('Y-m-d H:i:s'),
                	    'money' => $money,
                	    'area_id' => $areaId,
                	    'set_meal_id' => $id,
                	    'buyer_id' => $uid,
                	    'buyer_mobile' => mobile,
                	]
                );
        
        if (! $res) {
            $log->error('写订单失败');
        }
    }
    
    // 验证手机号获取归属地和运营商类型
    protected function actionCheckMobile()
    {
        $mobile = Util::getValueByKey($_GET, 'mobile');
        
        echo json_encode(Util::checkMobile($mobile));
    }
}
