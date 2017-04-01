<?php
namespace Fox\Controllers;

use \Fox\Core\Exceptions\Forbidden;
use Fox\Core\Utils\Util;

class Orders extends \Fox\Core\Controllers\Record
{
    public function actionExamine($params, $data, $request) {
        if (empty($data['ids'])) {
            return ['status' => 0, 'msg' => '审核失败，缺少id'];
        }
        if (empty($data['reasonId'])) {
            return ['status' => 0, 'msg' => '审核失败，缺少id'];
        }
        
        $allow = Util::getValueByKey($data, 'allow', 1);
        
        $q = $this->getcontainer()->make('query');
        
        // status 0未审核， 1审核通过， 2拒绝
        $r = $q->from('orders')
                ->where(
                    [
                        'id' => ['IN', $data['ids']],
                        'deleted' => 0,
                        'status' => ['IN', [0,1]],
                        ]
                )
                ->update(
                    [
                        'audit_status' => $allow ? 1 : 2,
                        'reason_id'    => $data['reasonId'],
                        'audit_by_id'  => $this->getUser()->get('id'),
                        'audit_at'     => date('Y-m-d H:i:s')
                    ]
                );
        
        $status = 0;
        $msg    = '审核失败';
        if ($r) {
            $status = 1;
            $msg    = '审核成功';
        }
        return ['status' => $status, 'msg' => $msg];
    }
    
    public function actionRead($params)
    {
        $arr = parent::actionRead($params);
        
        $id = $params['id'];
        
        // 获取图片
        $q = $this->getcontainer()->make('query');
        
        $res = $q->from('orders_img')->where('orders_id', $id)->read();
        
        $arr['imgs'] = [];
        if ($res) {
            $i = 0;
            foreach ($res as & $row) {
//                 $arr['imgs'][$i]['src'] = '/client/img/orders/' . $row['img_id'] . '.jpg';
//                 $arr['imgs'][$i]['id']  = $row['img_id'];
//                 $i ++;
                $arr['imgs'][] = $row['img_id'];
            }
        }
        return $arr;
    }
    
    public function actionDelete($params, $data, $request)
    {
        throw new Forbidden();
    }
}
