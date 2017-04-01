<?php


namespace Fox\Core\Utils;

class Module
{
    private $fileManager;

    private $config;

    private $unifier;

    protected $data = null;

    protected $cacheFile = 'data/cache/application/modules.php';

    protected $paths = array(
        'corePath' => 'application/Fox/Resources/module.json',
        'modulePath' => 'application/Fox/Modules/{*}/Resources/module.json',
        'customPath' => 'custom/Fox/Custom/Resources/module.json',
    );

    public function __construct(Config $config, File\Manager $fileManager)
    {
        $this->config = $config;
        $this->fileManager = $fileManager;

        $this->unifier = new \Fox\Core\Utils\File\FileUnifier($this->fileManager);
    }

    public function get($key = '', $returns = null)
    {
        if (!isset($this->data)) {
            $this->init();
        }

        if (empty($key)) {
            return $this->data;
        }

        return Util::getValueByKey($this->data, $key, $returns);
    }

    public function getAll()
    {
        return $this->get();
    }

    protected function init()
    {
        if (file_exists($this->cacheFile) && $this->config->get('useCache')) {
            $this->data = $this->fileManager->getPhpContents($this->cacheFile);
        } else {
            $this->data = $this->unifier->unify($this->paths, true);

            if ($this->config->get('useCache')) {
                $result = $this->fileManager->putPhpContents($this->cacheFile, $this->data);
                if ($result == false) {
                    throw new \Fox\Core\Exceptions\Error('Module - Cannot save unified modules.');
                }
            }
        }
    }
}
