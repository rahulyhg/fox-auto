<?php
namespace Fox\EntryPoints;

use \Fox\Core\Utils\Util;

/**
 * 抢单操作
 *
 * @date   2017-3-8 下午3:43:59
 * @author jqh
 */
class Order extends Base
{
    public static $authRequired = true;
    
    // 订单占有有效期
    protected $orderPeriod = 1795;

    public function handle()
    {
        if (! empty($_GET['a'])) {
            return $this->dispatch($_GET['a']);
        }
        $orderId = Util::getValueByKey($_GET, 'id');
        
        $user = $this->getUser();
        
        $app = $this->container->make('wechat');
        $js = $app->js;
        
        //获取jssdk 配置信息
        $config = $js->config(['uploadImage', 'downloadImage', 'chooseImage'], false, false, false);
        
//         logger()->error('提交抢单  ===> ', $config);
        
        $this->displayClient(
            'wechat', 'grab', [
                'row' => $this->getOrdersList($orderId),
                'now' => time(),
                'config' => $config,
                'orderId' => $orderId
            ]
        );
    }
    
    // 检测订单是否有效
    // 是返回true，否则返回false
    protected function checkOrdersValid($ordersId) 
    {
        $q = $this->container->make('query');
        
        $r = $q->from('orders')->select('created_at')->where(['id' => $ordersId, 'deleted' => 0])->readRow();
        
        if (! $r) {
            return false;
        }
        $c = strtotime($r['created_at']);

        if ($c + $this->orderPeriod < time()) {
            return false;
        }
        return true;
    }
    
    // 提交订单接口
    public function actionSubmit()
    {
        // 订单id
        $orderId = Util::getValueByKey($_GET, 'id');
        if (! $orderId) {
            return $this->returnJson(['status' => 0, 'msg' => '参数错误']);
        }
        
        if (! $this->checkOrdersValid($orderId)) {
            return $this->returnJson(['status' => 0, 'msg' => '订单已过期']);
        }
        
        $q = $this->container->make('query');
        
        $r = $q->from('orders')->where('id', $orderId)->update(['status' => 1]);
        
        if ($r) {
            return $this->returnJson(['status' => 1]);
        }
        
        return $this->returnJson(['status' => 0, 'msg' => '提交失败，请重试']);
    }
    
    // 删除图片
    protected function actionDelImg()
    {
        // 订单id
        $orderId = Util::getValueByKey($_GET, 'orderId');
        // 图片id
        $imgId   = Util::getValueByKey($_GET, 'id');
        
        if (! $orderId || ! $imgId) {
            return $this->returnJson(['status' => 0, 'msg' => '参数错误']);
        }
        
        logger()->error('删除图片 ===> ' . $orderId . ' ---' . $imgId);
        
        $q = $this->container->make('query');
        
        $q->from('orders_img')->where(['orders_id' => $orderId, 'img_id' => $imgId])->remove();
        
        $file = __ROOT__ . '/client/img/orders/' . $imgId . '.jpg';
        
        unlink($file);
        
        $this->returnJson(['status' => 1]);
    }
    
    // 下载图片
    protected function actionDownloadImg()
    {
        // 订单id
        $orderId = Util::getValueByKey($_GET, 'orderId');
        // 图片id
        $imgId   = Util::getValueByKey($_GET, 'imgId');
        
        if (! $orderId || ! $imgId) {
            return $this->returnJson(['status' => 0, 'msg' => '参数错误']);
        } 
        
        logger()->error('下载图片 ===> ' . $orderId . ' ---' . $imgId);
        
        $app = $this->container->make('wechat');
        
        $imgName       = Util::generateId();
        $storageFolder = __ROOT__ . '/client/img/orders';
        
        // 临时素材
        $temporary = $app->material_temporary;
//         $temporary->download($imgId, $storageFolder, "");
        $content = $temporary->getStream($imgId);
        
        $file = "$storageFolder/$imgName.jpg";
        
        file_put_contents($file, $content);
                
        $q = $this->container->make('query');
        
        $r = $q->from('orders_img')->insert(['orders_id' => $orderId, 'img_id' => $imgName]);
        if (! $r) {
            logger()->error('抢单提交图片失败');
            unlink($file);
            return $this->returnJson(['status' => 0, 'msg' => '提交图片失败']);
        }
        
        $this->returnJson(['status' => 1, 'id' => $imgName]);
    }
    
    protected function getOrdersList($orderId)
    {
        $q = $this->container->make('query');
        $r = $q->from('orders')
                ->select(['name', 'flow', 'flow_type', 'area_id', 'status', 'money', 'buyer_mobile', 'created_at'])
                ->where('id', $orderId)
                ->readRow();
        
        if (! $r) {
            return $r;
        }
        
        $res = $q->from('orders_img')->where('orders_id', $orderId)->read();
        
        $r['imgs'] = [];
        if ($res) {
            $i = 0;
            foreach ($res as & $row) {
                $r['imgs'][$i]['src'] = '/client/img/orders/' . $row['img_id'] . '.jpg';
                $r['imgs'][$i]['id']  = $row['img_id'];
                $i ++;
            }
        }
        
        $w = $q->from('area')->select('name')->where('id', $r['area_id'])->readRow();
        
        // 默认订单有效期为半小时
        $r['time'] = strtotime($r['created_at']) + $this->orderPeriod;

        $r['area_name'] = $w['name'];
        
        return $r;
    }
    
}
