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

class MessagePushConfigSingleton {
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

    private function __construct(){
        $configs = Tool::getConfig('messagepush.' . SY_ENV . SY_PROJECT);

        //设置阿里配置
        $aliConfig = new ConfigAli();
        $aliConfig->setAccessKey((string)Tool::getArrayVal($configs, 'ali.access.key', '', true));
        $aliConfig->setAccessSecret((string)Tool::getArrayVal($configs, 'ali.access.secret', '', true));
        $aliConfig->setRegionId((string)Tool::getArrayVal($configs, 'ali.region.id', '', true));
        $this->aliConfig = $aliConfig;

        //设置信鸽安卓配置
        $xinGeAndroidConfig = new ConfigXinGe();
        $xinGeAndroidConfig->setPlatform(ConfigXinGe::PLATFORM_TYPE_ANDROID);
        $xinGeAndroidConfig->setAppId((string)Tool::getArrayVal($configs, 'xinge.android.app.id', '', true));
        $xinGeAndroidConfig->setAppSecret((string)Tool::getArrayVal($configs, 'xinge.android.app.secret', '', true));
        $this->xinGeAndroidConfig = $xinGeAndroidConfig;

        //设置信鸽苹果配置
        $xinGeIosConfig = new ConfigXinGe();
        $xinGeIosConfig->setPlatform(ConfigXinGe::PLATFORM_TYPE_IOS);
        $xinGeIosConfig->setAppId((string)Tool::getArrayVal($configs, 'xinge.ios.app.id', '', true));
        $xinGeIosConfig->setAppSecret((string)Tool::getArrayVal($configs, 'xinge.ios.app.secret', '', true));
        $this->xinGeIosConfig = $xinGeIosConfig;
    }

    /**
     * @return \DesignPatterns\Singletons\MessagePushConfigSingleton
     */
    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \SyMessagePush\ConfigAli
     */
    public function getAliConfig() {
        return $this->aliConfig;
    }

    /**
     * @return \SyMessagePush\ConfigXinGe
     */
    public function getXinGeAndroidConfig() {
        return $this->xinGeAndroidConfig;
    }

    /**
     * @return \SyMessagePush\ConfigXinGe
     */
    public function getXinGeIosConfig() {
        return $this->xinGeIosConfig;
    }
}