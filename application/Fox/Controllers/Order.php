<?php
namespace Fox\Controllers;

use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Error;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;

class Order extends \Fox\Core\Controllers\Base
{
    public function actionList()
    {
        $Q = $this->getcontainer()->make('query');
        $rs = $Q->from('orders')->read();
        return $rs;
    }

    public function actionOrder($params)
    {
        $id = $params['id'];
        $Q = $this->getcontainer()->make('query');
        $rs = $Q->where('id', '=', $id)->from('orders')->limit(0, 10)->read();
        return (array_pop($rs));
    }

    public function actionShowTime($params)
    {
        date_default_timezone_set('PRC');
        $timestr = $params['time'];
        $nowtime = time();
        if ($timestr < $nowtime) {
            
        }

    }
}
