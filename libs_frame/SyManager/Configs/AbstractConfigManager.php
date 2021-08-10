<?php

namespace SyManager\Configs;

use Exception;
use RuntimeException;

/**
 * Class AbstractConfigManager
 *
 * @package SyManager\Configs
 */
abstract class AbstractConfigManager implements IConfigurable
{
    /** @var array */
    protected $configData;
    /** @var string */
    protected $configFilePath;

    /**
     * Create config object, optionally automatic load config
     * from argument $configFilePath
     *
     * @param string $configFilePath
     */
    public function __construct($configFilePath = null)
    {
        try {
            $this->loadConfig($configFilePath);
        } catch (Exception $exception) {
            // Allow not existent file name at construct
        }
    }

    /**
     * Get value from config data throught keyValue path
     *
     * @param string $configPath
     * @param mixed  $defaultValue
     *
     * @return mixed
     */
    public function getValue($configPath, $defaultValue = null)
    {
        $stored = $this->getValuePointer($configPath);

        return null === $stored
            ? $defaultValue
            : $stored;
    }

    /**
     * Check if exist required config for keyValue
     *
     * @param string $keyValue
     *
     * @return mixed
     */
    public function existValue($keyValue)
    {
        return null !== $this->getValue($keyValue);
    }

    /**
     * Set value in config path
     *
     * @param string $configPath
     * @param mixed  $newValue
     *
     * @return IConfigurable
     */
    public function setValue($configPath, $newValue)
    {
        $configData = &$this->getValuePointer($configPath);
        $configData = $newValue;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        return $this->configData;
    }

    /**
     * {@inheritdoc}
     */
    public function setConfig($config)
    {
        $this->configData = (array)$config;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function convert(IConfigurable $target)
    {
        $target->setConfig($this->getConfig());

        return $target;
    }

    /**
     * Get value pointer from config for get/set value
     *
     * @param string $configPath
     *
     * @return mixed
     */
    protected function &getValuePointer($configPath)
    {
        $configData = &$this->configData;
        $parts = explode('.', $configPath);
        $length = \count($parts);

        for ($i = 0; $i < $length; ++$i) {
            if (!isset($configData[$parts[$i]])) {
                $configData[$parts[$i]] = ($i === $length) ? [] : null;
            }

            $configData = &$configData[$parts[$i]];
        }

        return $configData;
    }

    /**
     * Check if configFilePath exists and is readable
     *
     * @return bool
     *
     * @throws RuntimeException
     */
    protected function checkLoadable()
    {
        if (null !== $this->configFilePath) {
            if (file_exists($this->configFilePath) && is_readable($this->configFilePath)) {
                // Readable
                return true;
            }

            // $configFilePath is not null, but not existent or not readable
            throw new RuntimeException("Failed to read config file from path '{$this->configFilePath}'");
        }

        // $configFilePath is null
        return false;
    }
}
