<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/18 0018
 * Time: 16:22
 */
namespace SyLogistics;

use DesignPatterns\Singletons\LogisticsConfigSingleton;

abstract class LogisticsBaseAliMarketAli extends LogisticsBase
{
    /**
     * 请求头
     * @var array
     */
    protected $reqHeader = [];
    /**
     * 服务uri
     * @var string
     */
    protected $serviceUri = '';

    public function __construct()
    {
        parent::__construct();
        $authCode = 'APPCODE ' . LogisticsConfigSingleton::getInstance()->getAliMarketAliConfig()->getAppCode();
        $this->reqHeader['Authorization'] = $authCode;
    }

    private function __clone()
    {
    }

    protected function getContent() : array
    {
        $config = LogisticsConfigSingleton::getInstance()->getAliMarketAliConfig();
        $url = $config->getServiceAddress() . $this->serviceUri;
        if (!empty($this->reqData)) {
            $url .= '?' . http_build_query($this->reqData);
        }
        $this->curlConfigs[CURLOPT_URL] = $url;
        $this->curlConfigs[CURLOPT_FAILONERROR] = false;
        $this->curlConfigs[CURLOPT_RETURNTRANSFER] = true;
        $this->curlConfigs[CURLOPT_HEADER] = false;
        $this->curlConfigs[CURLOPT_TIMEOUT_MS] = 2000;
        if ($config->getServiceProtocol() == 'https') {
            $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
            $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        }
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [];
        foreach ($this->reqHeader as $key => $val) {
            $this->curlConfigs[CURLOPT_HTTPHEADER][] = $key . ':' . $val;
        }
        return $this->curlConfigs;
    }
}
