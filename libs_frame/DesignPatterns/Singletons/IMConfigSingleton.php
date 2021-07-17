<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/6/29 0029
 * Time: 17:16
 */

namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyException\IM\TencentException;
use SyIM\ConfigTencent;
use SyTool\Tool;
use SyTrait\SingletonTrait;

class IMConfigSingleton
{
    use SingletonTrait;

    /**
     * 腾讯配置
     *
     * @var null|array
     */
    private $tencentConfigs;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\IMConfigSingleton
     */
    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $appId 应用ID
     *
     * @return \SyIM\ConfigTencent 腾讯配置
     *
     * @throws \SyException\IM\TencentException
     */
    public function getTencentConfig(string $appId): ConfigTencent
    {
        if (null === $this->tencentConfigs) {
            $this->tencentConfigs = [];
            $configs = Tool::getConfig('im.' . SY_ENV . SY_PROJECT . '.tencent');
            foreach ($configs as $eConfig) {
                $nowAppId = $eConfig['app_id'] ?? '';
                $tencentConfig = new ConfigTencent();
                $tencentConfig->setAppId($nowAppId);
                $tencentConfig->setPrivateKey($eConfig['private_key'] ?? '');
                $tencentConfig->setCommandSign($eConfig['command_sign'] ?? '');
                $tencentConfig->setAccountAdmin($eConfig['account_admin'] ?? '');
                $tencentConfig->setAccountType($eConfig['account_type'] ?? '');
                $this->tencentConfigs[$nowAppId] = $tencentConfig;
            }
        }

        if (isset($this->tencentConfigs[$appId])) {
            return $this->tencentConfigs[$appId];
        }

        throw new TencentException(ErrorCode::IM_PARAM_ERROR, '腾讯配置不存在');
    }

    public function getTencentConfigs(): array
    {
        return $this->tencentConfigs;
    }

    public function removeTencentConfig(string $appId)
    {
        if (\is_array($this->tencentConfigs)) {
            unset($this->tencentConfigs[$appId]);
        }
    }
}
