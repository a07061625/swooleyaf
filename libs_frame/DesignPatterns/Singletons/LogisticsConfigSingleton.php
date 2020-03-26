<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/18 0018
 * Time: 16:42
 */
namespace DesignPatterns\Singletons;

use SyLogistics\ConfigAliMarketAli;
use SyLogistics\ConfigKd100;
use SyLogistics\ConfigKdNiao;
use SyLogistics\ConfigTaoBao;
use SyTool\Tool;
use SyTrait\SingletonTrait;

class LogisticsConfigSingleton
{
    use SingletonTrait;
    /**
     * @var \SyLogistics\ConfigAliMarketAli
     */
    private $aliMarketAliConfig = null;
    /**
     * @var \SyLogistics\ConfigKd100
     */
    private $kd100Config = null;
    /**
     * @var \SyLogistics\ConfigKdNiao
     */
    private $kdNiaoConfig = null;
    /**
     * @var \SyLogistics\ConfigTaoBao
     */
    private $taoBaoConfig = null;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\LogisticsConfigSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \SyLogistics\ConfigAliMarketAli
     */
    public function getAliMarketAliConfig()
    {
        if (is_null($this->aliMarketAliConfig)) {
            $configs = Tool::getConfig('logistics.' . SY_ENV . SY_PROJECT . '.alimarket.ali');
            $protocol = (string)Tool::getArrayVal($configs, 'service.protocol', 'https', true);
            $domain = (string)Tool::getArrayVal($configs, 'service.domain', '', true);
            $aliMarketConfig = new ConfigAliMarketAli();
            $aliMarketConfig->setAppKey((string)Tool::getArrayVal($configs, 'app.key', '', true));
            $aliMarketConfig->setAppSecret((string)Tool::getArrayVal($configs, 'app.secret', '', true));
            $aliMarketConfig->setAppCode((string)Tool::getArrayVal($configs, 'app.code', '', true));
            $aliMarketConfig->setServiceAddress($protocol, $domain);
            $this->aliMarketAliConfig = $aliMarketConfig;
        }

        return $this->aliMarketAliConfig;
    }

    /**
     * @return \SyLogistics\ConfigKd100
     */
    public function getKd100Config()
    {
        if (is_null($this->kd100Config)) {
            $configs = Tool::getConfig('logistics.' . SY_ENV . SY_PROJECT);
            $kd100Config = new ConfigKd100();
            $kd100Config->setAppId((string)Tool::getArrayVal($configs, 'kd100.app.id', '', true));
            $kd100Config->setAppKey((string)Tool::getArrayVal($configs, 'kd100.app.key', '', true));
            $this->kd100Config = $kd100Config;
        }

        return $this->kd100Config;
    }

    /**
     * @return \SyLogistics\ConfigKdNiao
     */
    public function getKdNiaoConfig()
    {
        if (is_null($this->kdNiaoConfig)) {
            $configs = Tool::getConfig('logistics.' . SY_ENV . SY_PROJECT);
            $kdNiaoConfig = new ConfigKdNiao();
            $kdNiaoConfig->setBusinessId((string)Tool::getArrayVal($configs, 'kdniao.business.id', '', true));
            $kdNiaoConfig->setAppKey((string)Tool::getArrayVal($configs, 'kdniao.app.key', '', true));
            $this->kdNiaoConfig = $kdNiaoConfig;
        }

        return $this->kdNiaoConfig;
    }

    /**
     * @return \SyLogistics\ConfigTaoBao
     */
    public function getTaoBaoConfig()
    {
        if (is_null($this->taoBaoConfig)) {
            $configs = Tool::getConfig('logistics.' . SY_ENV . SY_PROJECT);
            $taoBaoConfig = new ConfigTaoBao();
            $taoBaoConfig->setAppKey((string)Tool::getArrayVal($configs, 'taobao.app.key', '', true));
            $taoBaoConfig->setAppSecret((string)Tool::getArrayVal($configs, 'taobao.app.secret', '', true));
            $this->taoBaoConfig = $taoBaoConfig;
        }

        return $this->taoBaoConfig;
    }
}
