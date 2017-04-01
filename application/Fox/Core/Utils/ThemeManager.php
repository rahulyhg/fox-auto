<?php
namespace Fox\Core\Utils;

class ThemeManager
{
    protected $config;

    protected $metadata;

    private $defaultName = 'Fox';
    
    protected $name;

    private $defaultStylesheet = 'Fox';

    public function __construct(Config $config, Metadata $metadata)
    {
        $this->config = $config;
        $this->metadata = $metadata;
        $this->name = $this->config->get('theme', $this->defaultName);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStylesheet()
    {
        return $this->metadata->get('themes.' . $this->name . '.stylesheet', 'client/css/jqh.css');
    }
    
    public function get($name, $default = null)
    {
        return $this->metadata->get("themes.{$this->name}.{$name}", $default);
    }
}
