<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/6/29 0029
 * Time: 17:16
 */
namespace DesignPatterns\Singletons;

use SySms\ConfigAliYun;
use SySms\ConfigDaYu;
use SySms\ConfigYun253;
use Tool\Tool;
use Traits\SingletonTrait;

class SmsConfigSingleton {
    use SingletonTrait;

    /**
     * 阿里云配置
     * @var \SySms\ConfigAliYun
     */
    private $aliYunConfig = null;
    /**
     * 大鱼配置
     * @var \SySms\ConfigDaYu
     */
    private $daYuConfig = null;
    /**
     * 253云配置
     * @var \SySms\ConfigYun253
     */
    private $yun253Config = null;

    private function __construct(){
        $configs = Tool::getConfig('sms.' . SY_ENV . SY_PROJECT);

        $aliYunConfig = new ConfigAliYun();
        $aliYunConfig->setAppKey((string)Tool::getArrayVal($configs, 'aliyun.app.key', '', true));
        $aliYunConfig->setAppSecret((string)Tool::getArrayVal($configs, 'aliyun.app.secret', '', true));
        $this->aliYunConfig = $aliYunConfig;

        $daYuConfig = new ConfigDaYu();
        $daYuConfig->setAppKey((string)Tool::getArrayVal($configs, 'dayu.app.key', '', true));
        $daYuConfig->setAppSecret((string)Tool::getArrayVal($configs, 'dayu.app.secret', '', true));
        $this->daYuConfig = $daYuConfig;

        $yun253Config = new ConfigYun253();
        $yun253Config->setAppKey((string)Tool::getArrayVal($configs, 'yun253.app.key', '', true));
        $yun253Config->setAppSecret((string)Tool::getArrayVal($configs, 'yun253.app.secret', '', true));
        $yun253Config->setUrlSmsSend((string)Tool::getArrayVal($configs, 'yun253.app.url.sms.send', '', true));
        $this->yun253Config = $yun253Config;
    }

    /**
     * @return \DesignPatterns\Singletons\SmsConfigSingleton
     */
    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \SySms\ConfigAliYun
     */
    public function getAliYunConfig() {
        return $this->aliYunConfig;
    }

    /**
     * @return \SySms\ConfigDaYu
     */
    public function getDaYuConfig() {
        return $this->daYuConfig;
    }

    /**
     * @return \SySms\ConfigYun253
     */
    public function getYun253Config() {
        return $this->yun253Config;
    }
}