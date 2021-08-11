<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/3/28 0028
 * Time: 10:29
 */

namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Live\BaiJiaException;
use SyLive\ConfigAliYun;
use SyLive\ConfigTencent;
use SyTool\Tool;
use SyTrait\Configs\AliCloudConfigTrait;
use SyTrait\LiveConfigTrait;
use SyTrait\SingletonTrait;

/**
 * Class LiveConfigSingleton
 *
 * @package DesignPatterns\Singletons
 */
class LiveConfigSingleton
{
    use SingletonTrait;
    use LiveConfigTrait;
    use AliCloudConfigTrait;

    /**
     * 阿里云配置
     *
     * @var string
     */
    private $aliYunKey = '';
    /**
     * 百家云配置列表
     *
     * @var array
     */
    private $baiJiaConfigs = [];
    /**
     * 百家云配置清理时间戳
     *
     * @var int
     */
    private $baiJiaClearTime = 0;
    /**
     * 腾讯云配置
     *
     * @var \SyLive\ConfigTencent
     */
    private $tencentConfig;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\LiveConfigSingleton
     */
    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 获取阿里云配置
     *
     * @return string 配置key
     *
     * @throws \SyException\Cloud\AliException
     * @throws \AlibabaCloud\Client\Exception\ClientException
     */
    public function getAliYunKey(): string
    {
        if ('' == $this->aliYunKey) {
            $configs = Tool::getConfig('live.' . SY_ENV . SY_PROJECT . '.aliyun');
            $config = new ConfigAliYun();
            $config->setRegionId((string)Tool::getArrayVal($configs, 'region.id', '', true));
            $config->setAccessKey((string)Tool::getArrayVal($configs, 'access.key', '', true));
            $config->setAccessSecret((string)Tool::getArrayVal($configs, 'access.secret', '', true));
            $this->setAliClient($config);
            $this->aliYunKey = $config->getAccessKey();
        }

        return $this->aliYunKey;
    }

    public function removeAliYunKey()
    {
        if (\strlen($this->aliYunKey) > 0) {
            $this->removeAliClient($this->aliYunKey);
            $this->aliYunKey = '';
        }
    }

    /**
     * 获取所有的百家云配置
     */
    public function getBaiJiaConfigs(): array
    {
        return $this->baiJiaConfigs;
    }

    /**
     * 获取百家云配置
     *
     * @throws \SyException\Live\BaiJiaException
     */
    public function getBaiJiaConfig(string $partnerId): ?\SyLive\ConfigBaiJia
    {
        $nowTime = Tool::getNowTime();
        $baiJiaConfig = $this->getLocalBaiJiaConfig($partnerId);
        if (null === $baiJiaConfig) {
            $baiJiaConfig = $this->refreshBaiJiaConfig($partnerId);
        } elseif ($baiJiaConfig->getExpireTime() < $nowTime) {
            $baiJiaConfig = $this->refreshBaiJiaConfig($partnerId);
        }

        if ($baiJiaConfig->isValid()) {
            return $baiJiaConfig;
        }

        throw new BaiJiaException('百家云配置不存在', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
    }

    /**
     * 移除百家云配置
     */
    public function removeBaiJiaConfig(string $partnerId)
    {
        unset($this->baiJiaConfigs[$partnerId]);
    }

    /**
     * 获取腾讯云配置
     *
     * @throws \SyException\Cloud\TencentException
     */
    public function getTencentConfig(): ConfigTencent
    {
        if (null === $this->tencentConfig) {
            $configs = Tool::getConfig('live.' . SY_ENV . SY_PROJECT . '.tencent');
            $tencentConfig = new ConfigTencent();
            $tencentConfig->setRegionId((string)Tool::getArrayVal($configs, 'region.id', '', true));
            $tencentConfig->setSecretId((string)Tool::getArrayVal($configs, 'secret.id', '', true));
            $tencentConfig->setSecretKey((string)Tool::getArrayVal($configs, 'secret.key', '', true));
            $this->tencentConfig = $tencentConfig;
        }

        return $this->tencentConfig;
    }

    /**
     * 获取本地百家云配置
     */
    private function getLocalBaiJiaConfig(string $partnerId): ?\SyLive\ConfigBaiJia
    {
        $nowTime = Tool::getNowTime();
        if ($this->baiJiaClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->baiJiaConfigs as $ePartnerId => $bjyConfig) {
                if ($bjyConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $ePartnerId;
                }
            }
            foreach ($delIds as $ePartnerId) {
                unset($this->baiJiaConfigs[$ePartnerId]);
            }

            $this->baiJiaClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_LIVE_BAIJIA_CLEAR;
        }

        return Tool::getArrayVal($this->baiJiaConfigs, $partnerId, null);
    }
}
