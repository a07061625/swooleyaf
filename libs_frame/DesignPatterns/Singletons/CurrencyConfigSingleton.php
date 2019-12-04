<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/12/4 0004
 * Time: 16:50
 */
namespace DesignPatterns\Singletons;

use SyCurrency\ConfigAliMarketYiYuan;
use SyTrait\SingletonTrait;
use Tool\Tool;

class CurrencyConfigSingleton
{
    use SingletonTrait;

    /**
     * @var \SyCurrency\ConfigAliMarketYiYuan
     */
    private $aliMarketYiYuanConfig = null;

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\CurrencyConfigSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \SyCurrency\ConfigAliMarketYiYuan
     */
    public function getAliMarketYiYuanConfig()
    {
        if (is_null($this->aliMarketYiYuanConfig)) {
            $configs = Tool::getConfig('currency.' . SY_ENV . SY_PROJECT . '.alimarket.yiyuan');
            $protocol = (string)Tool::getArrayVal($configs, 'service.protocol', 'https', true);
            $domain = (string)Tool::getArrayVal($configs, 'service.domain', '', true);
            $aliMarketConfig = new ConfigAliMarketYiYuan();
            $aliMarketConfig->setAppKey((string)Tool::getArrayVal($configs, 'app.key', '', true));
            $aliMarketConfig->setAppSecret((string)Tool::getArrayVal($configs, 'app.secret', '', true));
            $aliMarketConfig->setAppCode((string)Tool::getArrayVal($configs, 'app.code', '', true));
            $aliMarketConfig->setServiceAddress($protocol, $domain);
            $this->aliMarketYiYuanConfig = $aliMarketConfig;
        }

        return $this->aliMarketYiYuanConfig;
    }
}
