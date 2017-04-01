<?php


namespace Fox\Core\Portal\Utils;

use \Fox\Entities\Portal;

use \Fox\Core\Utils\Config;
use \Fox\Core\Utils\Metadata;

class ThemeManager extends \Fox\Core\Utils\ThemeManager
{
    public function __construct(Config $config, Metadata $metadata, Portal $portal)
    {
        $this->config = $config;
        $this->metadata = $metadata;
        $this->portal = $portal;
    }

    public function getName()
    {
        $theme = $this->portal->get('theme');
        if (!$theme) {
            $theme = $this->defaultName;
        }
        return $theme;
    }
}


