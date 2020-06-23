<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/6/29 0029
 * Time: 17:16
 */
namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\MessagePush\JPushException;
use SyMessagePush\ConfigAli;
use SyMessagePush\ConfigBaiDu;
use SyMessagePush\ConfigJPushDev;
use SyMessagePush\ConfigXinGe;
use SyTool\Tool;
use SyTrait\JPushConfigTrait;
use SyTrait\SingletonTrait;

class MessagePushConfigSingleton
{
    use SingletonTrait;
    use JPushConfigTrait;

    /**
     * 阿里配置
     * @var \SyMessagePush\ConfigAli
     */
    private $aliConfig = null;
    /**
     * 信鸽安卓配置
     * @var \SyMessagePush\ConfigXinGe
     */
    private $xinGeAndroidConfig = null;
    /**
     * 信鸽苹果配置
     * @var \SyMessagePush\ConfigXinGe
     */
    private $xinGeIosConfig = null;
    /**
     * 极光开发配置
     * @var \SyMessagePush\ConfigJPushDev
     */
    private $jPushDevConfig = null;
    /**
     * 极光应用配置列表
     * @var array
     */
    private $jPushAppConfigs = [];
    /**
     * 极光应用配置清理时间戳
     * @var int
     */
    private $jPushAppClearTime = 0;
    /**
     * 极光分组配置列表
     * @var array
     */
    private $jPushGroupConfigs = [];
    /**
     * 极光分组配置清理时间戳
     * @var int
     */
    private $jPushGroupClearTime = 0;
    /**
     * 极光开发配置
     * @var \SyMessagePush\ConfigBaiDu
     */
    private $baiDuConfig = null;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\MessagePushConfigSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \SyMessagePush\ConfigAli
     */
    public function getAliConfig()
    {
        if (is_null($this->aliConfig)) {
            $configs = Tool::getConfig('messagepush.' . SY_ENV . SY_PROJECT);
            $aliConfig = new ConfigAli();
            $aliConfig->setAccessKey((string)Tool::getArrayVal($configs, 'ali.access.key', '', true));
            $aliConfig->setAccessSecret((string)Tool::getArrayVal($configs, 'ali.access.secret', '', true));
            $aliConfig->setRegionId((string)Tool::getArrayVal($configs, 'ali.region.id', '', true));
            $this->aliConfig = $aliConfig;
        }

        return $this->aliConfig;
    }

    /**
     * @return \SyMessagePush\ConfigXinGe
     */
    public function getXinGeAndroidConfig()
    {
        if (is_null($this->xinGeAndroidConfig)) {
            $configs = Tool::getConfig('messagepush.' . SY_ENV . SY_PROJECT);
            $xinGeConfig = new ConfigXinGe();
            $xinGeConfig->setPlatform(ConfigXinGe::PLATFORM_TYPE_ANDROID);
            $xinGeConfig->setAppId((string)Tool::getArrayVal($configs, 'xinge.android.app.id', '', true));
            $xinGeConfig->setAppSecret((string)Tool::getArrayVal($configs, 'xinge.android.app.secret', '', true));
            $this->xinGeAndroidConfig = $xinGeConfig;
        }

        return $this->xinGeAndroidConfig;
    }

    /**
     * @return \SyMessagePush\ConfigXinGe
     */
    public function getXinGeIosConfig()
    {
        if (is_null($this->xinGeIosConfig)) {
            $configs = Tool::getConfig('messagepush.' . SY_ENV . SY_PROJECT);
            $xinGeConfig = new ConfigXinGe();
            $xinGeConfig->setPlatform(ConfigXinGe::PLATFORM_TYPE_IOS);
            $xinGeConfig->setAppId((string)Tool::getArrayVal($configs, 'xinge.ios.app.id', '', true));
            $xinGeConfig->setAppSecret((string)Tool::getArrayVal($configs, 'xinge.ios.app.secret', '', true));
            $this->xinGeIosConfig = $xinGeConfig;
        }

        return $this->xinGeIosConfig;
    }

    /**
     * @return \SyMessagePush\ConfigJPushDev
     */
    public function getJPushDevConfig()
    {
        if (is_null($this->jPushDevConfig)) {
            $configs = Tool::getConfig('messagepush.' . SY_ENV . SY_PROJECT);
            $devKey = (string)Tool::getArrayVal($configs, 'jpush.dev.key', '', true);
            $devSecret = (string)Tool::getArrayVal($configs, 'jpush.dev.secret', '', true);
            $devConfig = new ConfigJPushDev();
            $devConfig->setKeyAndSecret($devKey, $devSecret);
            $this->jPushDevConfig = $devConfig;
        }

        return $this->jPushDevConfig;
    }

    /**
     * @return array
     */
    public function getJPushAppConfigs()
    {
        return $this->jPushAppConfigs;
    }

    /**
     * @param string $key
     * @return \SyMessagePush\ConfigJPushApp|null
     */
    private function getLocalJPushAppConfig(string $key)
    {
        $nowTime = Tool::getNowTime();
        if ($this->jPushAppClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->jPushAppConfigs as $eKey => $appConfig) {
                if ($appConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $eKey;
                }
            }
            foreach ($delIds as $eKey) {
                unset($this->jPushAppConfigs[$eKey]);
            }

            $this->jPushAppClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_JPUSH_APP_CLEAR;
        }

        return Tool::getArrayVal($this->jPushAppConfigs, $key, null);
    }

    /**
     * @param string $key
     * @return \SyMessagePush\ConfigJPushApp
     * @throws \SyException\MessagePush\JPushException
     */
    public function getJPushAppConfig(string $key)
    {
        $nowTime = Tool::getNowTime();
        $appConfig = $this->getLocalJPushAppConfig($key);
        if (is_null($appConfig)) {
            $appConfig = $this->refreshJPushAppConfig($key);
        } elseif ($appConfig->getExpireTime() < $nowTime) {
            $appConfig = $this->refreshJPushAppConfig($key);
        }

        if ($appConfig->isValid()) {
            return $appConfig;
        } else {
            throw new JPushException('应用配置不存在', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param string $key
     */
    public function removeJPushAppConfig(string $key)
    {
        unset($this->jPushAppConfigs[$key]);
    }

    /**
     * @return array
     */
    public function getJPushGroupConfigs()
    {
        return $this->jPushGroupConfigs;
    }

    /**
     * @param string $key
     * @return \SyMessagePush\ConfigJPushGroup|null
     */
    private function getLocalJPushGroupConfig(string $key)
    {
        $nowTime = Tool::getNowTime();
        if ($this->jPushGroupClearTime < $nowTime) {
            $delIds = [];
            foreach ($this->jPushGroupConfigs as $eKey => $groupConfig) {
                if ($groupConfig->getExpireTime() < $nowTime) {
                    $delIds[] = $eKey;
                }
            }
            foreach ($delIds as $eKey) {
                unset($this->jPushGroupConfigs[$eKey]);
            }

            $this->jPushGroupClearTime = $nowTime + Project::TIME_EXPIRE_LOCAL_JPUSH_GROUP_CLEAR;
        }

        return Tool::getArrayVal($this->jPushGroupConfigs, $key, null);
    }

    /**
     * @param string $key
     * @return \SyMessagePush\ConfigJPushGroup
     * @throws \SyException\MessagePush\JPushException
     */
    public function getJPushGroupConfig(string $key)
    {
        $nowTime = Tool::getNowTime();
        $groupConfig = $this->getLocalJPushGroupConfig($key);
        if (is_null($groupConfig)) {
            $groupConfig = $this->refreshJPushGroupConfig($key);
        } elseif ($groupConfig->getExpireTime() < $nowTime) {
            $groupConfig = $this->refreshJPushGroupConfig($key);
        }

        if ($groupConfig->isValid()) {
            return $groupConfig;
        } else {
            throw new JPushException('分组配置不存在', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param string $key
     */
    public function removeJPushGroupConfig(string $key)
    {
        unset($this->jPushGroupConfigs[$key]);
    }

    /**
     * @return \SyMessagePush\ConfigBaiDu
     */
    public function getBaiDuConfig()
    {
        if (is_null($this->baiDuConfig)) {
            $configs = Tool::getConfig('messagepush.' . SY_ENV . SY_PROJECT);
            $baiDuConfig = new ConfigBaiDu();
            $baiDuConfig->setAppKey((string)Tool::getArrayVal($configs, 'baidu.app.key', '', true));
            $baiDuConfig->setAppSecret((string)Tool::getArrayVal($configs, 'baidu.app.secret', '', true));
            $baiDuConfig->setDeviceType((int)Tool::getArrayVal($configs, 'baidu.device.type', -1, true));
            $this->jPushDevConfig = $baiDuConfig;
        }

        return $this->baiDuConfig;
    }
}
