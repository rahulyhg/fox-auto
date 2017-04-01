<?php
namespace Fox\Controllers;

use \Fox\Core\Utils\Util;

class Reason extends \Fox\Core\Controllers\Record
{
    // 获取审核理由内容
    public function actionGetList($params, $data, $request)
    {
        $scope = Util::getValueByKey($_GET, 'scope', 'Orders');
        
        $q = $this->getcontainer()->make('query');
        $r = $q->from('reason')->where(['deleted' => 0, 'type' => $scope])->read();
        
        $arr = [
            1 => [],
            2 => [],
        ];
        
        if (! $r) {
            return $arr;
        }
        
        foreach ($r as & $row) {
            if ($row['status'] == 1) {
                $arr[1][] = $row;
            } else {
                $arr[2][] = $row;
            }
        }
        
        return $arr;
    }
}
