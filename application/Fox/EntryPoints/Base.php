<?php
namespace Fox\EntryPoints;

use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;
use GuzzleHttp\json_encode;

/**
 * 微信基础类
 *
 * @date   2017-2-17 上午11:44:16
 * @author jqh
 */
class Base extends \Fox\Core\EntryPoints\Base
{
    protected $query;
    
    protected function q()
    {
        if ($this->query) {
            return $this->query;
        }
        
        return $this->query = $this->container->make('query');
    }
    
    protected function getUser()
    {
        return $this->container->make('wechatAuth')->getUser();
    }
    
    protected function makeOrderNo()
    {
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j');
        return $yCode[date('Y') - 2011] . dechex(date('m')) . date('d') 
        . substr(time(), -5) 
        . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
    }
    
    protected function returnJson(array $data)
    {
        echo json_encode($data);
    }
    
    protected function returnMsg($msg, $status = 0, $others = [])
    {
        return $this->returnJson(['msg' => $msg, 'status' => $status] + $others);
    }
    
    protected function dispatch($type) {
        $action = 'action' . $type;
        $this->$action();
    }
    
    protected function displayClient($controller, $action, array $data = [])
    {
        $runScript = "
            app.getController('$controller', function(contr) {
                contr.doAction('$action')
            })
        ";
        
        $html = file_get_contents('html/wechat.html');
        
        $html = str_replace('{{cacheTimestamp}}', $this->getCacheTimestamp(), $html);
        $html = str_replace('{{useCache}}', 'false', $html);
        $html = str_replace('{{stylesheet}}', '', $html);//$this->getcontainer()->make('themeManager')->getStylesheet()
        $html = str_replace('{{runScript}}', $runScript, $html);
        $html = str_replace('{{basePath}}', '', $html);
        $html = str_replace('{{data}}', json_encode($data), $html);
        
        echo $html;
    }
    
    protected function getCacheTimestamp()
    {
        return time();
        if (!$this->getConfig()->get('useCache')) {
            return (string) time();
        }
        return $this->getConfig()->get('cacheTimestamp', 0);
    }
}
