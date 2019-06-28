<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/28 0028
 * Time: 19:54
 */
namespace SyLogistics;

use DesignPatterns\Singletons\LogisticsConfigSingleton;

abstract class LogisticsBaseKdNiao extends LogisticsBase
{
    /**
     * 请求头
     * @var array
     */
    protected $reqHeader = [];
    /**
     * 业务参数数组
     * @var array
     */
    protected $extendData = [];
    /**
     * 服务地址
     * @var string
     */
    protected $serviceUrl = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $this->reqData['EBusinessID'] = LogisticsConfigSingleton::getInstance()->getKdNiaoConfig()->getBusinessId();
        $this->reqData['DataType'] = '2';
    }

    private function __clone()
    {
    }

    protected function getContent() : array
    {
        $signRes = LogisticsUtilKdNiao::createSign($this->extendData);
        $this->reqData['RequestData'] = $signRes['encode_data'];
        $this->reqData['DataSign'] = $signRes['sign'];
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->curlConfigs[CURLOPT_RETURNTRANSFER] = true;
        $this->curlConfigs[CURLOPT_HEADER] = false;
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = http_build_query($this->reqData);
        if (!isset($this->curlConfigs[CURLOPT_TIMEOUT_MS])) {
            $this->curlConfigs[CURLOPT_TIMEOUT_MS] = 2000;
        }
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [];
        foreach ($this->reqHeader as $key => $val) {
            $this->curlConfigs[CURLOPT_HTTPHEADER][] = $key . ':' . $val;
        }
        return $this->curlConfigs;
    }
}
