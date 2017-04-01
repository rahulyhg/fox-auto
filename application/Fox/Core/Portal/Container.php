<?php


namespace Fox\Core\Portal;

class Container extends \Fox\Core\Container
{
    protected function getServiceClassName($name, $default)
    {
        $metadata = $this->get('metadata');
        $className = $metadata->get('app.serviceContainerPortal.classNames.' . $name, $default);
        return $className;
    }

    protected function loadAclManager()
    {
        $className = $this->getServiceClassName('aclManager', '\\Fox\\Core\\Portal\\AclManager');
        return new $className(
            $this->get('container')
        );
    }

    protected function loadAcl()
    {
        $className = $this->getServiceClassName('acl', '\\Fox\\Core\\Portal\\Acl');
        return new $className(
            $this->get('aclManager'),
            $this->get('user')
        );
    }

    protected function loadThemeManager()
    {
        return new \Fox\Core\Portal\Utils\ThemeManager(
            $this->get('config'),
            $this->get('metadata'),
            $this->get('portal')
        );
    }

    protected function loadLayout()
    {
        return new \Fox\Core\Portal\Utils\Layout(
            $this->get('fileManager'),
            $this->get('metadata'),
            $this->get('user')
        );
    }

    protected function loadLanguage()
    {
        $language = new \Fox\Core\Portal\Utils\Language(
            $this->get('fileManager'),
            $this->get('config'),
            $this->get('metadata'),
            $this->get('preferences')
        );
        $language->setPortal($this->get('portal'));
        return $language;
    }

    public function setPortal(\Fox\Entities\Portal $portal)
    {
        $this->set('portal', $portal);

        $data = array();
        foreach ($this->get('portal')->getSettingsAttributeList() as $attribute) {
            $data[$attribute] = $this->get('portal')->get($attribute);
        }
        if (empty($data['language'])) {
            unset($data['language']);
        }
        if (empty($data['theme'])) {
            unset($data['theme']);
        }
        if (empty($data['timeZone'])) {
            unset($data['timeZone']);
        }
        if (empty($data['dateFormat'])) {
            unset($data['dateFormat']);
        }
        if (empty($data['timeFormat'])) {
            unset($data['timeFormat']);
        }
        if (isset($data['weekStart']) && $data['weekStart'] === -1) {
            unset($data['weekStart']);
        }
        if (array_key_exists('weekStart', $data) && is_null($data['weekStart'])) {
            unset($data['weekStart']);
        }
        if (empty($data['defaultCurrency'])) {
            unset($data['defaultCurrency']);
        }

        foreach ($data as $attribute => $value) {
            $this->get('config')->set($attribute, $value, true);
        }
    }
}

