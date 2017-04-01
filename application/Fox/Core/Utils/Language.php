<?php
namespace Fox\Core\Utils;

use \Fox\Core\Utils\Util,
    \Fox\Core\Exceptions\NotFound,
    \Fox\Core\Exceptions\Error;
use Fox\Core\Utils\File\Unifier;

class Language
{
    private $fileManager;

    private $config;

    private $metadata;

    private $preferences;

    private $unifier;

    /**
     * Data of all languages
     *
     * @var array
     */
    private $data = array();

    private $deletedData = array();

    private $changedData = array();

    private $name = 'i18n';

    private $currentLanguage = null;

    protected $cacheFile = 'data/cache/application/languages/{*}.php';

    protected $defaultLanguage = 'en_US';

    /**
     * @var array
     */
    private $paths = array(
        'corePath' => 'application/Fox/Resources/i18n',
        'modulePath' => 'application/Fox/Modules/{*}/Resources/i18n',
        'customPath' => 'custom/Fox/Custom/Resources/i18n',
    );


    public function __construct(File\Manager $fileManager, Config $config, Metadata $metadata, Unifier $unifier, \Fox\Entities\Preferences $preferences = null)
    {
        $this->fileManager = $fileManager;
        $this->config = $config;
        $this->metadata = $metadata;
        $this->preferences = $preferences;

        $this->unifier = $unifier;//new \Fox\Core\Utils\File\Unifier($this->fileManager, $metadata);
        $this->unifier->setMetadata($metadata);
    }

    protected function getMetadata()
    {
        return $this->metadata;
    }

    public function getLanguage()
    {
        if (!isset($this->currentLanguage) && isset($this->preferences)) {
            $this->currentLanguage = $this->preferences->get('language');
        }

        if (empty($this->currentLanguage)) {
            $this->currentLanguage = $this->config->get('language');
        }

        return $this->currentLanguage;
    }

    public function setLanguage($language)
    {
        $this->currentLanguage = $language;
    }

    protected function getLangCacheFile()
    {
        $langCacheFile = str_replace('{*}', $this->getLanguage(), $this->cacheFile);

        return $langCacheFile;
    }

    /**
     * Translate label/labels
     *
     * @param  string $label name of label
     * @param  string $category
     * @param  string $scope
     * @param  array $requiredOptions List of required options.
     *  Ex., $requiredOptions = array('en_US', 'de_DE')
     *  "language" option has only array('en_US' => 'English (United States)',)
     *  Result will be array('en_US' => 'English (United States)', 'de_DE' => 'de_DE',)
     * @return string | array
     */
    public function translate($label, $category = 'labels', $scope = 'Global', $requiredOptions = null)
    {
        if (is_array($label)) {
            $translated = array();

            foreach ($label as & $subLabel) {
                $translated[$subLabel] = $this->translate($subLabel, $category, $scope, $requiredOptions);
            }

            return $translated;
        }

        $key = $scope.'.'.$category.'.'.$label;
        $translated = $this->get($key);

        if (!isset($translated)) {
            $key = 'Global.'.$category.'.'.$label;
            $translated = $this->get($key, $label);
        }

        if (is_array($translated) && isset($requiredOptions)) {

            $translated = array_intersect_key($translated, array_flip($requiredOptions));

            $optionKeys = array_keys($translated);
            foreach ($requiredOptions as & $option) {
                if (!in_array($option, $optionKeys)) {
                    $translated[$option] = $option;
                }
            }
        }

        return $translated;
    }

    public function translateOption($value, $field, $scope = 'Global')
    {
        $options = $this->get($scope. '.options.' . $field);
        if (is_array($options) && array_key_exists($value, $options)) {
            return $options[$value];
        }
        return $value;
    }

    public function get($key = null, $returns = null)
    {
        $data = $this->getData();

        if (!isset($data) || $data === false) {
            throw new Error('Language: current language ['.$this->getLanguage().'] does not found');
        }

        return Util::getValueByKey($data, $key, $returns);
    }

    public function & getAll()
    {
        return $this->get();
    }

    /**
     * Save changes
     *
     * @return bool
     */
    public function save()
    {
        $path = $this->paths['customPath'];
        $currentLanguage = $this->getLanguage();

        $result = true;
        if (!empty($this->changedData)) {
            foreach ($this->changedData as $scope => & $data) {
                if (!empty($data)) {
                    $result &= $this->fileManager->mergeContents(array($path, $currentLanguage, $scope.'.php'), $data, true);
                }
            }
        }

        if (!empty($this->deletedData)) {
            foreach ($this->deletedData as $scope => & $unsetData) {
                if (!empty($unsetData)) {
                    $result &= $this->fileManager->unsetContents(array($path, $currentLanguage, $scope.'.php'), $unsetData, true);
                }
            }
        }

        if ($result == false) {
            throw new Error("Error saving languages. See log file for details.");
        }

        $this->clearChanges();

        return (bool) $result;
    }

    /**
     * Clear unsaved changes
     *
     * @return void
     */
    public function clearChanges()
    {
        $this->changedData = array();
        $this->deletedData = array();
        $this->init(true);
    }

    /**
     * Get data of Unifier language files
     *
     * @return array
     */
    protected function getData()
    {
        $currentLanguage = $this->getLanguage();
        if (!isset($this->data[$currentLanguage])) {
            $this->init();
        }

        return $this->data[$currentLanguage];
    }

    /**
     * Set/change a label
     *
     * @param string $scope
     * @param string $category
     * @param string | array $name
     * @param mixed $value
     *
     * @return void
     */
    public function set($scope, $category, $name, $value)
    {
        if (is_array($name)) {
            foreach ($name as $rowLabel => & $rowValue) {
                $this->set($scope, $category, $rowLabel, $rowValue);
            }
            return;
        }

        $this->changedData[$scope][$category][$name] = $value;

        $currentLanguage = $this->getLanguage();
        if (!isset($this->data[$currentLanguage])) {
            $this->init();
        }
        $this->data[$currentLanguage][$scope][$category][$name] = $value;

        $this->undelete($scope, $category, $name);
    }

    /**
     * Remove a label
     *
     * @param  string $name
     * @param  string $category
     * @param  string $scope
     *
     * @return void
     */
    public function delete($scope, $category, $name)
    {
        if (is_array($name)) {
            foreach ($name as $rowLabel) {
                $this->delete($scope, $category, $rowLabel);
            }
            return;
        }

        $this->deletedData[$scope][$category][] = $name;

        $currentLanguage = $this->getLanguage();
        if (!isset($this->data[$currentLanguage])) {
            $this->init();
        }

        if (isset($this->data[$currentLanguage][$scope][$category][$name])) {
            unset($this->data[$currentLanguage][$scope][$category][$name]);
        }

        if (isset($this->changedData[$scope][$category][$name])) {
            unset($this->changedData[$scope][$category][$name]);
        }
    }

    protected function undelete($scope, $category, $name)
    {
        if (isset($this->deletedData[$scope][$category])) {
            foreach ($this->deletedData[$scope][$category] as $key => $labelName) {
                if ($name === $labelName) {
                    unset($this->deletedData[$scope][$category][$key]);
                }
            }
        }
    }

    protected function init($reload = false)
    {
        if ($reload || ! is_file($this->getLangCacheFile()) || !$this->config->get('useCache')) {
            $fullData = $this->unifier->unify($this->name, $this->paths, true);

            $result = true;
            foreach ($fullData as $i18nName => & $i18nData) {

                if ($i18nName != $this->defaultLanguage) {
                    $i18nData = Util::merge($fullData[$this->defaultLanguage], $i18nData);
                }

                $this->data[$i18nName] = & $i18nData;

                if ($this->config->get('useCache')) {
                    $i18nCacheFile = str_replace('{*}', $i18nName, $this->cacheFile);
                    $result &= $this->fileManager->putPhpContents($i18nCacheFile, $i18nData);
                }
            }

            if ($result == false) {
                throw new Error('Language::init() - Cannot save data to a cache');
            }
        }

        $currentLanguage = $this->getLanguage();
        if (empty($this->data[$currentLanguage])) {
            $this->data[$currentLanguage] = $this->fileManager->getPhpContents($this->getLangCacheFile());
        }
    }
}
