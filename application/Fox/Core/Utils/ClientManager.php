<?php
namespace Fox\Core\Utils;

class ClientManager
{
    private $themeManager;

    private $config;

    protected $mainHtmlFilePath = 'html/main.html';

    protected $htmlFilePathForDeveloperMode = 'frontend/html/main.html';

    protected $runScript = 'app.start()';

    protected $basePath = '';

    public function __construct(Config $config, ThemeManager $themeManager)
    {
        $this->config = $config;
        $this->themeManager = $themeManager;
    }

    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    public function getBasePath()
    {
        return $this->basePath;
    }

    protected function getCacheTimestamp()
    {
        if (! $this->config->get('useCache')) {
            return time();
        }
        return $this->config->get('cacheTimestamp', 0);
    }

    public function display($runScript = null, $htmlFilePath = null)
    {
        $runScript = $runScript ?: $this->runScript;
            
        $htmlFilePath = $htmlFilePath ?: $this->mainHtmlFilePath;

//         if ($this->config->get('isDeveloperMode')) {
//             if (is_file('frontend/' . $htmlFilePath)) {
//                 $htmlFilePath = 'frontend/' . $htmlFilePath;
//             }
//         }
        
        echo strtr(
            file_get_contents($htmlFilePath), 
            [
                '{{cacheTimestamp}}' => $this->getCacheTimestamp(),
                '{{useCache}}'       => $this->config->get('useCache') ? 'true' : 'false',
                '{{stylesheet}}'     => $this->themeManager->getStylesheet(),
                '{{runScript}}'      => $runScript,
                '{{basePath}}'       => $this->basePath,
            ]
        );
    }
}
