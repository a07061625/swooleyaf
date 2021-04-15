<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 13:59
 */

namespace SyTrait;

use SyConstant\Project;
use SyDouYin\ConfigApp;
use SyTool\Tool;

/**
 * Trait DouYinConfigTrait
 *
 * @package SyTrait
 */
trait DouYinConfigTrait
{
    /**
     * 更新应用配置
     *
     * @param string $clientKey 应用标识
     *
     * @return \SyDouYin\ConfigApp 应用配置
     *
     * @throws \SyException\DouYin\DouYinException
     */
    private function refreshAppConfig(string $clientKey): ConfigApp
    {
        $expireTime = Tool::getNowTime() + Project::TIME_EXPIRE_LOCAL_DOUYIN_APP_REFRESH;
        $appConfig = new ConfigApp();
        $appConfig->setClientKey($clientKey);
        $appConfig->setExpireTime($expireTime);

        //TODO: 从数据库、文件等存储获取应用配置数据并设置
        $configInfo = [];
        if (empty($configInfo)) {
            $appConfig->setValid(false);
        } else {
            $appConfig->setValid(true);
            $appConfig->setClientSecret($configInfo['secret']);
        }
        $this->appConfigs[$clientKey] = $appConfig;

        return $appConfig;
    }
}
