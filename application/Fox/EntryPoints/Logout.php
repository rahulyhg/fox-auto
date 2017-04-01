<?php
namespace Fox\EntryPoints;

use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;
use \Fox\Core\Utils\Util;
use GuzzleHttp\json_decode;
use EasyWeChat\Payment\Order;
use GuzzleHttp\json_encode;

class Logout extends \Fox\Core\EntryPoints\Base
{
    public static $authRequired = false;
    
    public function handle()
    {
        session_unset();
        session_destroy();
        
        setcookie('__user__', '', time() - 3600);
        
        echo "success";
    }
}
