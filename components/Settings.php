<?php

namespace yii2mod\settings\components;

use yii\helpers\ArrayHelper;
use yii\base\Component;
use yii\caching\Cache;
use Yii;
use yii\di\Instance;
use yii2mod\settings\models\enumerables\SettingType;

/**
 * Class Settings
 * @package yii2mod\settings\components
 */
class Settings extends Component
{
    /**
     * @var string setting model class name
     */
    public $modelClass = 'yii2mod\settings\models\SettingModel';

    /**
     * @var Cache|array|string the cache used to improve RBAC performance. This can be one of the followings:
     *
     * - an application component ID (e.g. `cache`)
     * - a configuration array
     * - a [[yii\caching\Cache]] object
     *
     * When this is not set, it means caching is not enabled.
     *
     */
    public $cache = 'cache';

    /**
     * @var string the key used to store settings data in cache
     */
    public $cacheKey = 'yii2mod-setting';

    /**
     * @var object setting model
     */
    protected $model;

    /**
     * @var array list of settings
     */
    protected $items;

    /**
     * @var mixed setting value
     */
    protected $setting;

    /**
     * Initialize the component
     */
    public function init()
    {
        parent::init();
        if ($this->cache !== null) {
            $this->cache = Instance::ensure($this->cache, Cache::className());
        }
        $this->model = new $this->modelClass;
    }

    /**
     * Get's the value for the given section and key.
     * @param $key
     * @param null $section
     * @param null $default
     * @return mixed
     */
    public function get($section, $key, $default = null)
    {
        $items = $this->getSettingsConfig();
        if (isset($items[$section][$key])) {
            $this->setting = ArrayHelper::getValue($items[$section][$key], 'value');
            $type = ArrayHelper::getValue($items[$section][$key], 'type');
            $this->convertSettingType($type);
        } else {
            $this->setting = $default;
        }
        return $this->setting;
    }

    /**
     * Add a new setting or update an existing one.
     * @param null $section
     * @param $key
     * @param $value
     * @param null $type
     * @return bool
     */
    public function set($section, $key, $value, $type = null)
    {
        if ($this->model->setSetting($section, $key, $value, $type)) {
            $this->invalidateCache();
            return true;
        }
        return null;
    }

    /**
     * Remove setting by section and key
     * @param string $section
     * @param string $key
     * @return bool
     */
    public function remove($section, $key)
    {
        if ($this->model->removeSetting($section, $key)) {
            $this->invalidateCache();
            return true;
        }
        return null;
    }

    /**
     * Returns the settings config
     *
     * @return array
     */
    protected function getSettingsConfig()
    {
        if (!$this->cache instanceof Cache) {
            $this->items = $this->model->getSettings();
        } else {
            $cacheItems = $this->cache->get($this->cacheKey);
            if (!empty($cacheItems)) {
                $this->items = $cacheItems;
            } else {
                $this->items = $this->model->getSettings();
                $this->cache->set($this->cacheKey, $this->items);
            }
        }

        return $this->items;
    }

    /**
     * Invalidate cache data
     */
    public function invalidateCache()
    {
        if ($this->cache !== null) {
            $this->cache->delete($this->cacheKey);
            $this->items = null;
        }
    }

    /**
     * Set type for setting
     * @param $type
     */
    protected function convertSettingType($type)
    {
        if ($type === SettingType::BOOLEAN_TYPE) {
            $this->setting = filter_var($this->setting, FILTER_VALIDATE_BOOLEAN);
        } else {
            settype($this->setting, $type);
        }
    }
}
