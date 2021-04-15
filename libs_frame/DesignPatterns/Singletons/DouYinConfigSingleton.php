<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 14:00
 */

namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyDouYin\ConfigApp;
use SyException\DouYin\DouYinException;
use SyTool\Tool;
use SyTrait\DouYinConfigTrait;
use SyTrait\SingletonTrait;

/**
 * Class DouYinConfigSingleton
 *
 * @package DesignPatterns\Singletons
 */
class DouYinConfigSingleton
{
    use SingletonTrait;
    use DouYinConfigTrait;

    /**
     * 应用配置列表
     *
     * @var array
     */
    private $appConfigs = [];
    /**
     * 应用配置清理时间戳
     *
     * @var int
     */
    private $appClearTime = 0;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\DouYinConfigSingleton
     */
    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 获取所有的应用配置
     *
     * @return array 应用配置列表
     */
    public function getAppConfigs(): array
    {
        return $this->appConfigs;
    }

    /**
     * 移除应用配置
     *
     * @param string $clientKey 应用标识
     */
    public function removeAppConfig(string $clientKey)
    {
        unset($this->appConfigs[$clientKey]);
    }

    /**
     * 获取应用配置
     *
     * @param string $clientKey 应用标识
     *
     * @return \SyDouYin\ConfigApp 应用配置
     *
     * @throws \SyException\DouYin\DouYinException
     */
    public function getAppConfig(string $clientKey): ConfigApp
    {
        $nowTime = Tool::getNowTime();
        $appConfig = $this->getLocalAppConfig($clientKey);
        if (null === $appConfig) {
            $appConfig = $this->refreshAppConfig($clientKey);
        } elseif ($appConfig->getExpireTime() < $nowTime) {
            $appConfig = $this->refreshAppConfig($clientKey);
        }

        if ($appConfig->isValid()) {
            return $appConfig;
        }

        throw new DouYinException('应用配置不存在', ErrorCode::DOUYIN_PARAM_ERROR);
    }

    /**
     * 获取本地应用配置
     *
     * @param string $clientKey 应用标识
     *
     * @return null|\SyDouYin\ConfigApp 应用配置
     */
    private function getLocalAppConfig(string $clientKey): ?ConfigApp
    {
        $nowTime = Tool::getNowTime();
        if ($this->appClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->appConfigs as $eClientKey => $appConfig) {
                if ($appConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $eClientKey;
                }
            }
            foreach ($delIds as $eClientKey) {
                unset($this->appConfigs[$eClientKey]);
            }

            $this->appClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_DOUYIN_APP_CLEAR;
        }

        return Tool::getArrayVal($this->appConfigs, $clientKey, null);
    }
}
