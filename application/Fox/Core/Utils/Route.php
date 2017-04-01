<?php
namespace Fox\Core\Utils;

class Route
{
    protected $data = null;

    private $fileManager;
    private $config;
    private $metadata;

//     protected $cacheFile = 'data/cache/application/routes.php';

    protected $paths = 'application/Fox/Resources/routes.php';

    public function __construct(Config $config = null, Metadata $metadata = null, File\Manager $fileManager = null)
    {
        $this->config      = $config;
        $this->metadata    = $metadata;
        $this->fileManager = $fileManager;
        
        $this->init();
    }

    public function get($key = '', $returns = null)
    {
        if (empty($key)) {
            return $this->data;
        }

        $lastRoute = $this->data;
        foreach(explode('.', $key) as & $keyName) {
            if (isset($lastRoute[$keyName]) && is_array($lastRoute)) {
                $lastRoute = $lastRoute[$keyName];
            } else {
                return $returns;
            }
        }

        return $lastRoute;
    }
    
    public function & getAll()
    {
        return $this->data;
    }

    protected function init()
    {
        $this->data = require __ROOT__ . '/' . $this->paths;
    }

}
