<?php
namespace Fox\EntryPoints;

use \Fox\Core\Utils\Util;

/**
 * 抢单首页
 *
 * @date   2017-3-8 下午2:56:43
 * @author jqh
 */
class Home extends Base
{
    public static $authRequired = false;
    
    protected $rowsNum = 10;

    public function handle()
    {
        if (! empty($_GET['a'])) {
            return $this->dispatch($_GET['a']);
        }
        
        // 判断用户归属信息
        $setBelongs = false;
        $belongs = $this->getBelongsInfo();
        if (empty($belongs) || empty($belongs['type'])) {
            $setBelongs = true;
        }

        $w = [
            'status' => ['IN', [0, 3]],
            'deleted' => 0
        ];
        
        if ($belongs) {
            $w['area_id']   = ['IN', [100, $belongs['area']]];
            $w['flow_type'] = $belongs['type'];
        }
        
        $total = $this->getCount($w);
        
        $list = [];
        if ($total) {
            $allPages = ceil($total / $this->rowsNum);
            
            // 获取随机页数
            $page = $this->getRandomPage($allPages, Util::getValueByKey($_REQUEST, 'page'));
            
            $list = $this->getList($w, $page);
        }
        
        $this->displayClient('wechat', 'home', [
            'rows'       => $list,
            'total'      => $total,
            'areas'      => $this->getAreas(),
            'page'       => $page,
            'belongs'    => $belongs,
            'setBelongs' => $setBelongs
        ]);
    }
    
    // 获取随机页数
    protected function getRandomPage($allPages, $nowPage)
    {
        if ($allPages == 1) {
            return 1;
        }
        
        $page = mt_rand(1, $allPages);
        
        if ($page == $nowPage && $allPages > 2) {
            return $this->getRandomPage($allPages, $nowPage);
            
        } elseif ($page == $nowPage && $allPages == 2) {
            return $page == 1 ? 2 : 1;
            
        }
        
        return $page;
    }
    
    // 判断用户是否已填写归属信息
    protected function getBelongsInfo()
    {
        $user = $this->getUser();
        $uid  = $user['id'];
        $q = $this->q();
        $r = $q->from('account_ext')->select(['area_id area', 'operator_type type'])->where('id', $uid)->readRow();
        
        return $r ?: false;
    }
    
    // 设置省份和归属地信息
    protected function actionSetBelongsTo()
    {
        // 区域
        $province = Util::getValueByKey($_GET, 'area');
        // 运营商类型
        $type = Util::getValueByKey($_GET, 'type');
        
        if ($province == 100 || ! $province) {
            return $this->returnMsg('请选择正确的归属地！');
        }
        
        $ts = [1, 2, 3];
        if (! in_array($type, $ts)) {
            return $this->returnMsg('请选择正确的运营商类型！');
        }
        
        $q = $this->q();
        
        $uid = '23213ddas';
        $user = $this->getUser();
        $uid  = $user['id'];

        $r = $q->from('account_ext')->select('id')->where('id', $uid)->readRow();
        
        $data = [
            'area_id'       => $province,
            'operator_type' => $type
        ];
        
        // 存在则修改，不存在则新增
        if ($r) {
            $res = $q->from('account_ext')->where('id', $uid)->update($data);
        } else {
            $data['qr_url']        = '';
            $data['qr_created_at'] = '00-00-00 00:00:00';
            $data['qr_ticket']     = '';
            $data['scene_id']      = '';
            $data['id']            = $uid;
            
            $res = $q->from('account_ext')->insert($data);
        }
        if ($res) {
            return $this->returnMsg('', 1);
        }
        
        return $this->returnMsg('设置失败，请重试');
    }
    
    // 抢单接口
    protected function actionGrab()
    {
        $orderId = Util::getValueByKey($_GET, 'id');
        
        if (! $orderId) {
            return $this->returnJson(['status' => 0, 'msg' => '参数错误']);
        }
        
        // 用户id
        $uid = '23213ddas';
        
        $q = $this->q();
        
//         // 获取用户信息
        $user = $this->getUser();
        
        $uid = $user['id'];
        
        if (! $this->checkUser($uid)) {
            return $this->returnJson(['status' => 0, 'msg' => '请您先处理已抢订单']);
        }
        
        $pdo = $this->getEntityManager()->getPDO();
        
        //开启事务
        $pdo->beginTransaction();
        
        // 占用订单
        $r = $q->from('buy_orders')
                ->where(
                    [
                        'id'      => $orderId,
                        'status'  => ['IN', [0, 3]],// 防止并发抢单 
                        'deleted' => 0,
                    ]
                )
                ->update(
                    [
                        'status' => 1
                    ]
                );
        
        if (! $r) {
            return $this->returnJson(['status' => 0, 'msg' => '抢单失败，请重试']);
        }

        // 取出订单详情
        $r = $q->from('buy_orders')
                ->select(
                    [
                        'name', 'flow', 'flow_type', 'area_id', 'money', 'buyer_mobile'
                    ]
                )
                ->where('id', $orderId)
                ->readRow();
        if (! $r) {
            logger()->error('抢单失败，获取订单信息失败');
            $pdo->rollBack();
            return $this->returnJson(['status' => 0, 'msg' => '抢单失败，获取订单信息失败']);
        }
        
        $id = Util::generateId();
        
        // 插入抢单表
        $i = $q->from('orders')->insert(
            [
                'id'            => $id,
                'name'          => $this->makeOrderNo(),
                'flow'          => $r['flow'],
                'flow_type'     => $r['flow_type'],
                'area_id'       => $r['area_id'],
                'money'         => $r['money'],
                'seller_id'     => $uid,
                'seller_mobile' => 0,
                'buy_order_no'  => $r['name'],
                'buyer_mobile'  => $r['buyer_mobile'],
                'created_at'    => date('Y-m-d H:i:s'),
//                 'audit_opinion' => '',
                'desc'          => '',
                'audit_at'      => '0000-00-00 00:00:00',
                'audit_by_id'   => '',
            ]
        );
        
        if (! $i) {
            $pdo->rollBack();
            logger()->error('抢单失败：生成订单失败');
            return $this->returnJson(['status' => 0, 'msg' => '抢单失败：生成订单失败']);
        }
        
        
        $pdo->commit();
        $this->returnJson(['status' => 1, 'oid' => $id]);
    }
    
    // 检测用户是否抢了多个单
    protected function checkUser($uid)
    {
        $q = $this->q();
        $r = $q->from('orders')
                ->select('id')
                ->where(['seller_id' => $uid, 'status' => ['IN', [0, 3], 'deleted' => 0]])
                ->readRow();
    
        if ($r) {
            return false;
        }
        return true;
    }
    
    protected function getCount(array $w)
    {
        $q = $this->q();
        return $q->from('buy_orders')->where($w)->count();
    }
    
    // 获取订单信息
    protected function getList(array $w, $page)
    {
        $q = $this->q();
        
        $offset = ($page - 1) * $this->rowsNum;
        
        return $q->from('buy_orders')
                ->select(
                    [
                        'id', 'name', 'flow', 'money', 'flow_type', 'area_id'
                    ]
                )
                ->where($w)
                ->limit($offset, $this->rowsNum)
                ->read();
    }
    
    // 获取区域信息
    protected function getAreas()
    {
        $q = $this->q();
        $list = $q->select(['id', 'name'])->from('area')->read();
        
        $news = [];
        foreach ($list as & $r) {
            $news[$r['id']] = $r['name'];
        }
        
        return $news;
    }

}
