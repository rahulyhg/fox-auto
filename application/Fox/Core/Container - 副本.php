<?php
namespace Fox\Core;

use \EasyWeChat\Foundation\Application as App;

class Container
{

    private $data = array();


    /**
     * Constructor
     */
    public function __construct()
    {
    }

    public function get($name)
    {
        if (empty($this->data[$name])) {
            $this->load($name);
        }
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
        return null;
    }

    protected function set($name, $obj)
    {
        $this->data[$name] = $obj;
    }
    
    private function load($name)
    {
        $loadMethod = 'load' . ucfirst($name);
        if (method_exists($this, $loadMethod)) {
            $obj = $this->$loadMethod();
            $this->data[$name] = $obj;
        } else {

            try {
                $className = $this->get('metadata')->get('app.loaders.' . ucfirst($name));
            } catch (\Exception $e) {}

            if (!isset($className) || !class_exists($className)) {
                $className = '\Fox\Custom\Core\Loaders\\'.ucfirst($name);
                if (!class_exists($className)) {
                    $className = '\Fox\Core\Loaders\\'.ucfirst($name);
                }
            }

            if (class_exists($className)) {
                 $loadClass = new $className($this);
                 $this->data[$name] = $loadClass->load();
            }
        }

        return null;
    }
    
    protected function loadPdo()
    {
         return new \Fox\ORM\Support\DB\PDO($this->get('entityManager')->getPDO());
    }
    
    protected function loadQuery()
    {
        return new \Fox\ORM\Support\Query(
            new \Fox\ORM\Support\Builders\BuilderManager($this)
        );
    }

    protected function getServiceClassName($name, $default)
    {
        $metadata = $this->get('metadata');
        $className = $metadata->get('app.serviceContainer.classNames.' . $name, $default);
        return $className;
    }
    
    protected function loadWechatAuth()
    {
        return new \Fox\Core\Utils\Authentication\Wechat($this, $this->get('wechat'));
    }
    
    protected function loadWechat()
    {
        return new App($this->get('config')->get('wechat'));
//         $options = [
//             /**
//              * Debug 模式，bool 值：true/false
//              *
//              * 当值为 false 时，所有的日志都不会记录
//              */
//             'debug'  => $c->get('wechat.debug', true),
//             /**
//              * 账号基本信息，请从微信公众平台/开放平台获取
//              */
//             'app_id'  => $c->get('wechat.app_id'),         // AppID
//             'secret'  => $c->get('wechat.secret'),     // AppSecret
//             'token'   => $c->get('wechat.token'),          // Token
//             'aes_key' => $c->get('wechat.aes_key'),                    // EncodingAESKey，安全模式下请一定要填写！！！
//             /**
//              * 日志配置
//              *
//              * level: 日志级别, 可选为：
//              *         debug/info/notice/warning/error/critical/alert/emergency
//              * permission：日志文件权限(可选)，默认为null（若为null值,monolog会取0644）
//              * file：日志文件位置(绝对路径!!!)，要求可写权限
//              */
//             'log' => [
//                 'level'      => 'debug',
//                 'permission' => $c->get('wechat.log.permission', 0777),
//                 'file'       => $c->get('wechat.log.file', 'data/logs/easywechat.log'),
//             ],
//             /**
//              * OAuth 配置
//              *
//              * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
//              * callback：OAuth授权完成后的回调页地址
//              */
//             'oauth' => [
//                 'scopes'   => $c->get('wechat.oauth.scopes', ['snsapi_userinfo']),
//                 'callback' => $c->get('wechat.oauth.callback'),
//             ],
//             /**
//              * 微信支付
//              */
//             'payment' => [
//                 'merchant_id'        => $c->get('wechat.payment.merchant_id'),
//                 'key'                => $c->get('wechat.payment.key'),
//                 'cert_path'          => $c->get('wechat.payment.cert_path'), // XXX: 绝对路径！！！！
//                 'key_path'           => $c->get('wechat.payment.key_path'),      // XXX: 绝对路径！！！！
//                 // 'device_info'     => '013467007045764',
//                 // 'sub_app_id'      => '',
//                 // 'sub_merchant_id' => '',
//                 // ...
//             ],
//             /**
//              * Guzzle 全局设置
//              *
//              * 更多请参考： http://docs.guzzlephp.org/en/latest/request-options.html
//              */
//             'guzzle' => [
//                 'timeout' => $c->get('wechat.guzzle.timeout', 3.0), // 超时时间（秒）
//                 //'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
//             ],
//         ];
    }

    protected function loadLog()
    {
        $config = $this->get('config');

        $path = $config->get('logger.path', 'data/logs/fox.log');
        $rotation = $config->get('logger.rotation', true);

        $log = new \Fox\Core\Utils\Log('Fox');
        $levelCode = $log->getLevelCode($config->get('logger.level', 'WARNING'));

        if ($rotation) {
            $maxFileNumber = $config->get('logger.maxFileNumber', 30);
            $handler = new \Fox\Core\Utils\Log\Monolog\Handler\RotatingFileHandler($path, $maxFileNumber, $levelCode);
        } else {
            $handler = new \Fox\Core\Utils\Log\Monolog\Handler\StreamHandler($path, $levelCode);
        }
        $log->pushHandler($handler);

        $errorHandler = new \Monolog\ErrorHandler($log);
        $errorHandler->registerExceptionHandler(null, false);
        $errorHandler->registerErrorHandler(array(), false);

        return $log;
    }

    protected function loadContainer()
    {
        return $this;
    }

    protected function loadSlim()
    {
        return new \Fox\Core\Utils\Api\Slim();
    }

    protected function loadFileManager()
    {
        return new \Fox\Core\Utils\File\Manager(
            $this->get('config')
        );
    }

    protected function loadPreferences()
    {
        return $this->get('entityManager')->getEntity('Preferences', $this->get('user')->id);
    }

    protected function loadConfig()
    {
        return new \Fox\Core\Utils\Config(
            new \Fox\Core\Utils\File\Manager()
        );
    }

    protected function loadHookManager()
    {
        return new \Fox\Core\HookManager(
            $this
        );
    }

    protected function loadOutput()
    {
        return new \Fox\Core\Utils\Api\Output(
            $this->get('slim')
        );
    }

    protected function loadMailSender()
    {
        $className = $this->getServiceClassName('mailSernder', '\\Fox\\Core\\Mail\\Sender');
        return new $className(
            $this->get('config'),
            $this->get('entityManager')
        );
    }

    protected function loadDateTime()
    {
        return new \Fox\Core\Utils\DateTime(
            $this->get('config')->get('dateFormat'),
            $this->get('config')->get('timeFormat'),
            $this->get('config')->get('timeZone')
        );
    }

    protected function loadNumber()
    {
        return new \Fox\Core\Utils\Number(
            $this->get('config')->get('decimalMark'),
            $this->get('config')->get('thousandSeparator')
        );
    }

    protected function loadServiceFactory()
    {
        return new \Fox\Core\ServiceFactory(
            $this
        );
    }

    protected function loadSelectManagerFactory()
    {
        return new \Fox\Core\SelectManagerFactory(
            $this->get('entityManager'),
            $this->get('user'),
            $this->get('acl'),
            $this->get('metadata')
        );
    }

    protected function loadMetadata()
    {
        return new \Fox\Core\Utils\Metadata(
            $this->get('config'),
            $this->get('fileManager')
        );
    }

    protected function loadLayout()
    {
        return new \Fox\Core\Utils\Layout(
            $this->get('fileManager'),
            $this->get('metadata'),
            $this->get('user')
        );
    }

    protected function loadAclManager()
    {
        $className = $this->getServiceClassName('acl', '\\Fox\\Core\\AclManager');
        return new $className(
            $this->get('container')
        );
    }

    protected function loadAcl()
    {
        $className = $this->getServiceClassName('acl', '\\Fox\\Core\\Acl');
        return new $className(
            $this->get('aclManager'),
            $this->get('user')
        );
    }
    
    protected function loadSchema()
    {
        return new \Fox\Core\Utils\Database\Schema\Schema(
            $this->get('config'),
            $this->get('metadata'),
            $this->get('fileManager'),
            $this->get('entityManager'),
            $this->get('classParser')
        );
    }

    protected function loadClassParser()
    {
        return new \Fox\Core\Utils\File\ClassParser(
            $this->get('fileManager'),
            $this->get('config'),
            $this->get('metadata')
        );
    }

    protected function loadLanguage()
    {
        return new \Fox\Core\Utils\Language(
            $this->get('fileManager'),
            $this->get('config'),
            $this->get('metadata'),
            $this->get('preferences')
        );
    }

    protected function loadCrypt()
    {
        return new \Fox\Core\Utils\Crypt(
            $this->get('config')
        );
    }

    protected function loadScheduledJob()
    {
        return new \Fox\Core\Utils\ScheduledJob(
            $this
        );
    }

    protected function loadDataManager()
    {
        return new \Fox\Core\DataManager(
            $this
        );
    }

    protected function loadFieldManager()
    {
        return new \Fox\Core\Utils\FieldManager(
            $this->get('metadata'),
            $this->get('language')
        );
    }

    protected function loadThemeManager()
    {
        return new \Fox\Core\Utils\ThemeManager(
            $this->get('config'),
            $this->get('metadata')
        );
    }

    protected function loadClientManager()
    {
        return new \Fox\Core\Utils\ClientManager(
            $this->get('config'),
            $this->get('themeManager')
        );
    }

    public function setUser(\Fox\Entities\User $user)
    {
        $this->set('user', $user);
    }
}

