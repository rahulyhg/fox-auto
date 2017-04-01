<?php
namespace Fox\Controllers;

class Tactics extends \Fox\Core\Controllers\Record
{
    // 审核接口
    public function actionExamine($params, $data, $request) {
        if (empty($data['ids'])) {
            return ['status' => 0, 'msg' => '审核失败，缺少id'];
        }
        if (empty($data['reasonId'])) {
            return ['status' => 0, 'msg' => '审核失败，缺少id'];
        }
        
        
        $this->updateCancel($data);
        
        $allow = $data['allow'];
        
        $q = $this->getcontainer()->make('query');
        
        // status 0未审核， 1审核通过， 2拒绝
        $r = $q->from('tactics')
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
                        'reason_id'   => $data['reasonId'],
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
    
    protected function updateCancel(& $data)
    {
        $q = $this->getcontainer()->make('query');
    
        foreach ($data['attrs'] as & $row) {
            $q->from('tactics')
            ->where(
            	   [
            	       'name'    => $row->name,
            	       'status'  => 1,
            	       'deleted' => 0,
            	       'id'      => ['!=', $row->id],
            	   ]
            )
            ->update(
            	   ['status' => 5]
            );
        }
    }
}
