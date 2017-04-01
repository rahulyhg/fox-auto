<?php
namespace Fox\Core\Utils\File;

use \Fox\Core\Utils\Util;
use \Fox\Core\Utils\File\Manager;
use \Fox\Core\Utils\Config;
use \Fox\Core\Utils\Metadata;

class ClassParser
{
    private $fileManager;

    private $config;

    private $metadata;

    protected $cacheFile = null;

    protected $allowedMethods = array(
        'run',
    );

    public function __construct(Manager $fileManager, Config $config, Metadata $metadata)
    {
        $this->fileManager = $fileManager;
        $this->config = $config;
        $this->metadata = $metadata;
    }

    public function setAllowedMethods($methods)
    {
        $this->allowedMethods = $methods;
    }

    /**
     * Return path data of classes
     *
     * @param  string  $cacheFile full path for a cache file, ex. data/cache/application/entryPoints.php
     * @param  string | array $paths in format array(
     *    'corePath' => '',
     *    'modulePath' => '',
     *    'customPath' => '',
     * );
     * @return array
     */
    public function getData($paths, $cacheFile = false)
    {
        $data = null;

        if (is_string($paths)) {
            $paths = array(
                'corePath' => $paths,
            );
        }

        if ($cacheFile && is_file($cacheFile) && $this->config->get('useCache')) {
            $data = $this->fileManager->getPhpContents($cacheFile);
        } else {
            $data = $this->getClassNameHash($paths['corePath']);

            if (isset($paths['modulePath'])) {
                foreach ($this->metadata->getModuleList() as & $moduleName) {
                    $path = str_replace('{*}', $moduleName, $paths['modulePath']);

                    $data = array_merge($data, $this->getClassNameHash($path));
                }
            }

            if (isset($paths['customPath'])) {
                $data = array_merge($data, $this->getClassNameHash($paths['customPath']));
            }

            if ($cacheFile && $this->config->get('useCache')) {
                $result = $this->fileManager->putPhpContents($cacheFile, $data);
                if ($result == false) {
                    throw new \Fox\Core\Exceptions\Error();
                }
            }
        }

        return $data;
    }

    protected function getClassNameHash($dirs)
    {
        if (is_string($dirs)) {
            $dirs = (array) $dirs;
        }

        $data = array();
        foreach ($dirs as & $dir) {
            if (is_dir($dir)) {
                $fileList = $this->fileManager->getFileList($dir, false, '\.php$', true);

                foreach ($fileList as & $file) {
                    $filePath = Util::concatPath($dir, $file);
                    $className = Util::getClassName($filePath);
                    $fileName = $this->fileManager->getFileName($filePath);

                    $scopeName = ucfirst($fileName);
                    $normalizedScopeName = Util::normilizeScopeName($scopeName);

                    if (empty($this->allowedMethods)) {
                        $data[$normalizedScopeName] = $className;
                        continue;
                    }

                    foreach ($this->allowedMethods as & $methodName) {
                        if (method_exists($className, $methodName)) {
                            $data[$normalizedScopeName] = $className;
                        }
                    }

                }
            }
        }

        return $data;
    }

}
