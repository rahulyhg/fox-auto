<?php
$GLOBALS['__app__'] = Fox\Core\Container::getInstance();

/**
 * 1
 * 服务容器自动载入接口
 *
 * @return instance
 * */
if (! function_exists('app')) {
    function app($abstract = null)
    {
        return $abstract ? $GLOBALS['__app__']->make($abstract) : $GLOBALS['__app__'];
    }
}

if (! function_exists('pdo')) {
    function pdo()
    {
        return $GLOBALS['__app__']->make('pdo');
    }
}

/**
 * 2
 * 获取配置信息
 *
 * @param string $name 多级参数用"."隔开, 如 C('db.mysql')
 * @param string|array|null $default 默认值
 * @return mixed
 * */
if (! function_exists('C')) {
    function C($key, $default = null)
    {
        return $GLOBALS['__app__']->make('config')->get($key, $default);
    }
}

/**
 * 3
 * 获取数据仓库（可以对数据进行增删改查）
 * 在不需要模型的情况下建议直接调用此函数进行数据库操作 ，消耗较小
 * 使用示例：
 * 	Q()->where('id', '>', 1)->read();
 *
 * @param string $name 模型名称，注意：大小写敏感！！！
 * @return instance
 * */
if (! function_exists('Q')) {
    function Q()
    {
        return $GLOBALS['__app__']->make('query');
    }
}


/**
 * 6
 * 获取日志处理实例
 * 代理monolog处理日志方法, 使用前请先通过配置文件定义好相应的日志通道信息
 *
 * 使用示例:
 *  logger()->info('啦啦~'); //此方法会在日志信息后面带上REQUEST_METHOD和__URI__等信息, info表示日志级别
 * 输出如下:
 *  [2016-09-18 18:12:58] JQH.INFO: 啦啦~ [GET: /api/Index/index] [] []
 *
 *  logger()->addInfo('啦啦~');//此方法推送原始日志信息, info表示日志级别
 * 输出如下:
 *  [2016-09-18 18:13:16] JQH.INFO: 啦啦~ [] []
 *
 * @param sting 通道名称
 * @return instance
 * */
if (! function_exists('logger')) {
    function logger($channelName = 'exception')
    {
        return $GLOBALS['__app__']->make('logger');
    }
}

/**
 * 获取http客户端方法
 * */
if (! function_exists('http')) {
    function http()
    {
        return $GLOBALS['__app__']->make('http.client');
    }
}

/**
 * 获取get, post参数
 *
 * @param string $name 	键名
 * @param mixed $def 	默认值
 * @param bool $isEmpty 是否为空
 * @param bool $clean   是否防止xss攻击和sql注入
 * @return mixed
 * */
if (! function_exists('I')) {
    function I($name = null, $default = null, $isEmpty = false, $clean = true)
    {
        if (! $name) {
            # 不进行xss攻击和sql注入过滤
            return file_get_contents('php://input');
        }
    
        if ($isEmpty) {
            if (empty($_REQUEST[$name])) {
                return $default;
            }
            return $clean ? xss_clean($_REQUEST[$name]) : $_REQUEST[$name];
        }
    
        if (! isset($_REQUEST[$name])) {
            return $default;
        }
        return $clean && $_REQUEST[$name] ? xss_clean($_REQUEST[$name]) : $_REQUEST[$name];
    }
}

# 防止xss攻击和sql注入
if (! function_exists('xss_clean')) {
    function xss_clean($data, $complete = false, $isImage = false)
    {
        if (is_array($data)) {
            foreach ($data as & $v) {
                $v = xss_clean($v);
            }
            return $data;
        }
        if ($complete === false) {
            return htmlspecialchars($data);
        }
        return $GLOBALS['__app__']->make('http.input')->xssClean($data, $isImage);
    }
}

/**
 * session管理函数
 * @param string|array $name session名称 如果为数组则表示进行session设置
 * @param mixed $value session值
 * @return mixed
 */
if (! function_exists('session')) {
    function session($name='',$value='')
    {
        $prefix   =  C('SESSION_PREFIX');
        if (is_array($name)) { // session初始化 在session_start 之前调用
            if (isset($name['prefix'])) $prefix = $name['prefix'];
            	
            if (isset($name['id'])) {
                session_id($name['id']);
            }
            	
            if (isset($name['name']))            session_name($name['name']);
            if (isset($name['path']))            session_save_path($name['path']);
            if (isset($name['domain']))          ini_set('session.cookie_domain', $name['domain']);
            if (isset($name['expire']))          {
                ini_set('session.gc_maxlifetime',   $name['expire']);
                ini_set('session.cookie_lifetime',  $name['expire']);
            }
            if (isset($name['use_trans_sid']))   ini_set('session.use_trans_sid', $name['use_trans_sid']?1:0);
            if (isset($name['use_cookies']))     ini_set('session.use_cookies', $name['use_cookies']?1:0);
            if (isset($name['cache_limiter']))   session_cache_limiter($name['cache_limiter']);
            if (isset($name['cache_expire']))    session_cache_expire($name['cache_expire']);
            if (isset($name['type']))            C('SESSION_TYPE',$name['type']);
            if (C('SESSION_TYPE')) { // 读取session驱动
                $type   =   C('SESSION_TYPE');
                $class  =   strpos($type,'\\')? $type : 'Think\\Session\\Driver\\'. ucwords(strtolower($type));
                $hander =   new $class();
                session_set_save_handler(
                array(&$hander,"open"),
                array(&$hander,"close"),
                array(&$hander,"read"),
                array(&$hander,"write"),
                array(&$hander,"destroy"),
                array(&$hander,"gc"));
            }
            // 启动session
            if (C('SESSION_AUTO_START'))  session_start();
        }elseif ('' === $value) {
            if (''===$name) {
                // 获取全部的session
                return $prefix ? $_SESSION[$prefix] : $_SESSION;
            }elseif (0===strpos($name,'[')) { // session 操作
                if ('[pause]'==$name) { // 暂停session
                    session_write_close();
                }elseif ('[start]'==$name) { // 启动session
                    session_start();
                }elseif ('[destroy]'==$name) { // 销毁session
                    $_SESSION =  array();
                    session_unset();
                    session_destroy();
                }elseif ('[regenerate]'==$name) { // 重新生成id
                    session_regenerate_id();
                }
            }elseif (0===strpos($name,'?')) { // 检查session
                $name   =  substr($name,1);
                if (strpos($name,'.')) { // 支持数组
                    list($name1,$name2) =   explode('.',$name);
                    return $prefix?isset($_SESSION[$prefix][$name1][$name2]):isset($_SESSION[$name1][$name2]);
                } else {
                    return $prefix?isset($_SESSION[$prefix][$name]):isset($_SESSION[$name]);
                }
            }elseif (is_null($name)) { // 清空session
                if ($prefix) {
                    unset($_SESSION[$prefix]);
                } else {
                    $_SESSION = array();
                }
            }elseif ($prefix) { // 获取session
                if (strpos($name,'.')) {
                    list($name1,$name2) =   explode('.',$name);
                    return isset($_SESSION[$prefix][$name1][$name2])?$_SESSION[$prefix][$name1][$name2]:null;
                } else {
                    return isset($_SESSION[$prefix][$name])?$_SESSION[$prefix][$name]:null;
                }
            } else {
                if (strpos($name,'.')) {
                    list($name1,$name2) =   explode('.',$name);
                    return isset($_SESSION[$name1][$name2])?$_SESSION[$name1][$name2]:null;
                } else {
                    return isset($_SESSION[$name])?$_SESSION[$name]:null;
                }
            }
        }elseif (is_null($value)) { // 删除session
            if (strpos($name,'.')) {
                list($name1,$name2) =   explode('.',$name);
                if ($prefix) {
                    unset($_SESSION[$prefix][$name1][$name2]);
                } else {
                    unset($_SESSION[$name1][$name2]);
                }
            } else {
                if ($prefix) {
                    unset($_SESSION[$prefix][$name]);
                } else {
                    unset($_SESSION[$name]);
                }
            }
        } else { // 设置session
            if (strpos($name,'.')) {
                list($name1,$name2) = explode('.',$name);
                if ($prefix) {
                    $_SESSION[$prefix][$name1][$name2]   =  $value;
                } else {
                    $_SESSION[$name1][$name2]  =  $value;
                }
            } else {
                if ($prefix) {
                    $_SESSION[$prefix][$name]   =  $value;
                } else {
                    $_SESSION[$name]  =  $value;
                }
            }
        }
        return null;
    }
}

/**
 * Cookie 设置、获取、删除
 * @param string $name cookie名称
 * @param mixed $value cookie值
 * @param mixed $option cookie参数
 * @return mixed
 */
if (! function_exists('cookie')) {
    function cookie($name = '', $value = '', $option = null)
    {
        // 默认设置
        $config = array(
            'prefix'    =>  C('COOKIE_PREFIX'), // cookie 名称前缀
            'expire'    =>  C('COOKIE_EXPIRE'), // cookie 保存时间
            'path'      =>  C('COOKIE_PATH'), // cookie 保存路径
            'domain'    =>  C('COOKIE_DOMAIN'), // cookie 有效域名
            'secure'    =>  C('COOKIE_SECURE'), //  cookie 启用安全传输
            'httponly'  =>  C('COOKIE_HTTPONLY'), // httponly设置
        );
        // 参数设置(会覆盖黙认设置)
        if (!is_null($option)) {
            if (is_numeric($option))
                $option = array('expire' => $option);
            elseif (is_string($option))
            parse_str($option, $option);
            $config     = array_merge($config, array_change_key_case($option));
        }
        if(!empty($config['httponly'])){
            ini_set("session.cookie_httponly", 1);
        }
        // 清除指定前缀的所有cookie
        if (is_null($name)) {
            if (empty($_COOKIE))
                return null;
            // 要删除的cookie前缀，不指定则删除config设置的指定前缀
            $prefix = empty($value) ? $config['prefix'] : $value;
            if (!empty($prefix)) {// 如果前缀为空字符串将不作处理直接返回
                foreach ($_COOKIE as $key => $val) {
                    if (0 === stripos($key, $prefix)) {
                        setcookie($key, '', time() - 3600, $config['path'], $config['domain'],$config['secure'],$config['httponly']);
                        unset($_COOKIE[$key]);
                    }
                }
            }
            return null;
        }elseif('' === $name){
            // 获取全部的cookie
            return $_COOKIE;
        }
        $name = $config['prefix'] . str_replace('.', '_', $name);
        if ('' === $value) {
            if(isset($_COOKIE[$name])){
                $value =    $_COOKIE[$name];
                if(0===strpos($value,'think:')){
                    $value  =   substr($value,6);
                    return array_map('urldecode',json_decode(MAGIC_QUOTES_GPC?stripslashes($value):$value,true));
                }else{
                    return $value;
                }
            }else{
                return null;
            }
        } else {
            if (is_null($value)) {
                setcookie($name, '', time() - 3600, $config['path'], $config['domain'],$config['secure'],$config['httponly']);
                unset($_COOKIE[$name]); // 删除指定cookie
            } else {
                // 设置cookie
                if(is_array($value)){
                    $value  = 'think:'.json_encode(array_map('urlencode',$value));
                }
                $expire = !empty($config['expire']) ? time() + intval($config['expire']) : 0;
                setcookie($name, $value, $expire, $config['path'], $config['domain'],$config['secure'],$config['httponly']);
                $_COOKIE[$name] = $value;
            }
        }
        return null;
    }
}

/**
 * 驼峰命名转化为下划线命名
 * */
if (! function_exists('get_db_field')) {
    function get_db_field($str)
    {
        $str = preg_replace_callback('/([A-Z])/', 'to_db_field', $str);
        return trim($str, '_');
    }
}

if (! function_exists('to_db_field')) {
    function to_db_field(& $text)
    {
        return '_' . strtolower($text[1]);
    }
}

/**
 * 调试函数
 * */
if (! function_exists('debug')) {
    function debug($data, $print = true, $json = false)
    {
        echo '<pre>';
        $s  = '<span style="color:#66ccff">';
        $se = '</span>';
        if (is_string($data) || is_bool($data) || is_float($data) || is_integer($data)) {
            echo $s . date('[H:i:s]') . $se .  " $data<br/>";
            return;
        }
    
        if ($json) {
            return debug(json_encode($data));
        }
        if ($print) {
            print_r($data);
        } else {
            var_dump($data);
        }
        echo "<br/><br/>";
    
    }
}
