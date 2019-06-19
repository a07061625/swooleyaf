<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/6/29 0029
 * Time: 17:16
 */
namespace DesignPatterns\Singletons;

use SyMessagePush\ConfigAli;
use SyMessagePush\ConfigXinGe;
use Tool\Tool;
use Traits\SingletonTrait;

class MessagePushConfigSingleton
{
    use SingletonTrait;

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
}
