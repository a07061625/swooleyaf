<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/6/29 0029
 * Time: 17:16
 */
namespace DesignPatterns\Singletons;

use SyIM\TencentConfig;
use SyTool\Tool;
use SyTrait\SingletonTrait;

class IMConfigSingleton
{
    use SingletonTrait;

    /**
     * 腾讯配置
     * @var \SyIM\TencentConfig
     */
    private $tencentConfig = null;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\IMConfigSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \SyIM\TencentConfig
     */
    public function getTencentConfig()
    {
        if (is_null($this->tencentConfig)) {
            $configs = Tool::getConfig('im.' . SY_ENV . SY_PROJECT);
            $tencentConfig = new TencentConfig();
            $tencentConfig->setAppId((string)Tool::getArrayVal($configs, 'tencent.app.id', '', true));
            $tencentConfig->setPrivateKey((string)Tool::getArrayVal($configs, 'tencent.private.key', '', true));
            $tencentConfig->setCommandSign((string)Tool::getArrayVal($configs, 'tencent.command.sign', '', true));
            $tencentConfig->setAccountAdmin((string)Tool::getArrayVal($configs, 'tencent.account.admin', '', true));
            $tencentConfig->setAccountType((string)Tool::getArrayVal($configs, 'tencent.account.type', '', true));
            $this->tencentConfig = $tencentConfig;
        }

        return $this->tencentConfig;
    }
}
