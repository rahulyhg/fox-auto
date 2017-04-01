<?php
// 服务注册绑定
$app = Fox\Core\Container::getInstance();

$app->singleton('preferences', function ($container) {
    // 匿名函数必须返回一个对象
    return $container->make('entityManager')->getEntity('Preferences', $container->make('user')->id);
});

$app->singleton('logger', function ($container) {
    $config = $container->make('config');
    
    $path = $config->get('logger.path', 'data/logs/jqh.log');
    $rotation = $config->get('logger.rotation', true);
    
    $log = new \Fox\Core\Utils\Log\Monolog\Logger('Jqh');
    $levelCode = $log->getLevelCode($config->get('logger.level', 'DEBUG'));
    
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
});
