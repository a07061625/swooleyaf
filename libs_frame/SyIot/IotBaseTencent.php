<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/23 0023
 * Time: 8:53
 */
namespace SyIot;

abstract class IotBaseTencent extends IotBase
{
    /**
     * 请求头
     * @var array
     */
    protected $reqHeader = [];
    /**
     * 服务域名
     * @var string
     */
    private $serviceDomain = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader = [
            'Content-Type' => 'application/json',
            'Expect' => '',
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param string $serviceDomain
     */
    public function setServiceDomain(string $serviceDomain)
    {
        $domain = trim($serviceDomain);
        if (strlen($domain) > 0) {
            $this->serviceDomain = $domain;
        }
    }

    protected function getContent() : array
    {
        $this->curlConfigs[CURLOPT_NOSIGNAL] = true;
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = http_build_query($this->reqData);
        $this->curlConfigs[CURLOPT_RETURNTRANSFER] = true;
        $this->curlConfigs[CURLOPT_HEADER] = false;
        $reqHeaderArr = [];
        foreach ($this->reqHeader as $headerKey => $headerVal) {
            $reqHeaderArr[] = $headerKey . ': ' . $headerVal;
        }
        $this->curlConfigs[CURLOPT_HTTPHEADER] = $reqHeaderArr;
        if (!isset($this->curlConfigs[CURLOPT_TIMEOUT_MS])) {
            $this->curlConfigs[CURLOPT_TIMEOUT_MS] = 2000;
        }
        return $this->curlConfigs;
    }
}
