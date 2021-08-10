<?php

namespace AlibabaCloud\Client\Config;

use Exception;
use SyManager\Configs\ConfigManager;

/**
 * Class Config
 *
 * @package   AlibabaCloud\Client\Config
 */
class Config
{
    /**
     * @var null|ConfigManager
     */
    private static $configManager;

    /**
     * @param string      $configPath
     * @param null|string $defaultValue
     *
     * @return mixed
     */
    public static function get($configPath, $defaultValue = null)
    {
        return self::getConfigManager()->getValue(strtolower($configPath), $defaultValue);
    }

    /**
     * @param string $configPath
     * @param mixed  $newValue
     *
     * @return ConfigManager
     *
     * @throws Exception
     */
    public static function set($configPath, $newValue)
    {
        self::getConfigManager()->setValue(strtolower($configPath), $newValue);

        return self::getConfigManager()->saveConfigFile();
    }

    /**
     * @return ConfigManager
     */
    private static function getConfigManager()
    {
        if (!self::$configManager instanceof ConfigManager) {
            self::$configManager = new ConfigManager(__DIR__ . \DIRECTORY_SEPARATOR);
        }

        return self::$configManager;
    }
}
