<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/18 0018
 * Time: 16:22
 */
namespace SyLogistics;

use DesignPatterns\Singletons\LogisticsConfigSingleton;
use TaoBao\ServiceBase;
use TaoBao\UtilBase;

abstract class LogisticsBaseTaoBao extends ServiceBase
{
    public function __construct()
    {
        parent::__construct();
        $config = LogisticsConfigSingleton::getInstance()->getTaoBaoConfig();
        $this->appKey = $config->getAppKey();
        $this->appSecret = $config->getAppSecret();
        $this->curlConfigs[CURLOPT_URL] = UtilBase::getEnvUrl(UtilBase::ENV_TYPE_PRODUCT);
    }

    private function __clone()
    {
    }
}
