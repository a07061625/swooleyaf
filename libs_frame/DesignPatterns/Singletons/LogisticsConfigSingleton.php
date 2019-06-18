<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/18 0018
 * Time: 16:42
 */
namespace DesignPatterns\Singletons;

use SyLogistics\ConfigAliMart;
use Tool\Tool;
use Traits\SingletonTrait;

class LogisticsConfigSingleton
{
    use SingletonTrait;
    /**
     * @var \SyLogistics\ConfigAliMart
     */
    private $aliMartConfig = null;

    private function __construct()
    {
        $configs = Tool::getConfig('logistics.' . SY_ENV . SY_PROJECT);

        $protocol = (string)Tool::getArrayVal($configs, 'alimart.service.protocol', 'https', true);
        $domain = (string)Tool::getArrayVal($configs, 'alimart.service.domain', '', true);
        $aliMartConfig = new ConfigAliMart();
        $aliMartConfig->setAppKey((string)Tool::getArrayVal($configs, 'alimart.app.key', '', true));
        $aliMartConfig->setAppSecret((string)Tool::getArrayVal($configs, 'alimart.app.secret', '', true));
        $aliMartConfig->setAppCode((string)Tool::getArrayVal($configs, 'alimart.app.code', '', true));
        $aliMartConfig->setServiceAddress($protocol, $domain);
        $this->aliMartConfig = $aliMartConfig;
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
     * @return \SyLogistics\ConfigAliMart
     */
    public function getAliMartConfig()
    {
        return $this->aliMartConfig;
    }
}
