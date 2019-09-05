<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/23 0023
 * Time: 8:53
 */
namespace SyIot;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\IotConfigSingleton;
use SyException\Iot\TencentIotException;

abstract class IotBaseTencent extends IotBase
{
    /**
     * 请求头
     * @var array
     */
    protected $reqHeader = [];
    /**
     * 服务名称
     * @var string
     */
    protected $serviceName = '';
    /**
     * 服务域名
     * @var string
     */
    private $serviceDomain = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceName = 'iot';
        $this->serviceDomain = 'iotexplorer.tencentcloudapi.com';
        $config = IotConfigSingleton::getInstance()->getTencentConfig();
        $this->reqHeader = [
            'Content-Type' => 'application/json',
            'Host' => $this->serviceDomain,
            'Expect' => '',
            'X-TC-Region' => $config->getRegionId(),
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param string $serviceDomain
     * @throws \SyException\Iot\TencentIotException
     */
    public function setServiceDomain(string $serviceDomain)
    {
        if (strlen($serviceDomain) > 0) {
            $this->serviceDomain = $serviceDomain;
            $this->reqHeader['Host'] = $serviceDomain;
        } else {
            throw new TencentIotException('重定向链接不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * 添加请求签名
     */
    protected function addReqSign()
    {
        $postData = http_build_query($this->reqData);
        $signRes = IotUtilTencent::createTC3Sign([
            'req_headers' => $this->reqHeader,
            'req_data' => $postData,
            'service_name' => $this->serviceName,
        ]);
        $this->reqHeader['X-TC-Timestamp'] = $signRes['timestamp'];
        $this->reqHeader['Authorization'] = $signRes['authorization'];
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $postData;
    }

    protected function getContent() : array
    {
        $this->curlConfigs[CURLOPT_URL] = 'https://' . $this->serviceDomain;
        $this->curlConfigs[CURLOPT_NOSIGNAL] = true;
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $this->curlConfigs[CURLOPT_POST] = true;
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
