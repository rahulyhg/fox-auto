<?php
namespace Fox\Controllers;

class Encashment extends \Fox\Core\Controllers\Record
{
    // 审核接口
    public function actionExamine($params, $data, $request) {
        if (empty($data['ids'])) {
            return ['status' => 0, 'msg' => '审核失败，缺少id'];
        }
        
        $allow = $data['allow'];
        $desc  = $data['desc'];
        
        $q = $this->getcontainer()->make('query');
        
        // status 0未审核， 1审核通过， 2拒绝
        $r = $q->from('encashment')
                ->where(
                    [
                        'id' => ['IN', $data['ids']],
                        'deleted' => 0,
                        'status' => 0,
                    ]
                )
                ->update(
                    [
                        'status'      => $allow ? 1 : 2,
                        'desc'        => $desc,
                        'audit_by_id' => $this->getUser()->get('id'),
                        'audit_at'    => date('Y-m-d H:i:s')
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
}
