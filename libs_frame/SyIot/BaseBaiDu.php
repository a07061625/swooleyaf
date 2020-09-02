<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/17 0017
 * Time: 14:09
 */
namespace SyIot;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;

abstract class BaseBaiDu extends Base
{
    const REQ_METHOD_GET = 'GET'; //请求方式-
    const REQ_METHOD_POST = 'POST'; //请求方式-POST
    const REQ_METHOD_PUT = 'PUT'; //请求方式-PUT
    const REQ_METHOD_DELETE = 'DELETE'; //请求方式-DELETE
    const REQ_METHOD_HEAD = 'HEAD'; //请求方式-HEAD

    /**
     * 服务协议
     * @var string
     */
    protected $serviceProtocol = '';
    /**
     * 服务域名
     * @var string
     */
    protected $serviceDomain = '';
    /**
     * 服务uri
     * @var string
     */
    protected $serviceUri = '';
    /**
     * 请求头
     * @var array
     */
    protected $reqHeader = [];

    public function __construct()
    {
        parent::__construct();
        $this->serviceProtocol = 'https';
        $this->serviceDomain = 'iot.gz.baidubce.com';
        $this->reqHeader = [
            'Host' => $this->serviceDomain,
            'Content-Type' => 'application/json; charset=utf-8',
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param string $serviceProtocol
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setServiceProtocol(string $serviceProtocol)
    {
        if (in_array($serviceProtocol, ['http', 'https'])) {
            $this->serviceProtocol = $serviceProtocol;
        } else {
            throw new BaiDuIotException('服务协议不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $serviceDomain
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setServiceDomain(string $serviceDomain)
    {
        if (in_array($serviceDomain, ['iot.bj.baidubce.com', 'iot.gz.baidubce.com'])) {
            $this->serviceDomain = $serviceDomain;
            $this->reqHeader['Host'] = $serviceDomain;
        } else {
            throw new BaiDuIotException('服务域名不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    protected function getContent() : array
    {
        $this->curlConfigs[CURLOPT_RETURNTRANSFER] = true;
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $this->curlConfigs[CURLOPT_HEADER] = false;
        if (!isset($this->curlConfigs[CURLOPT_TIMEOUT_MS])) {
            $this->curlConfigs[CURLOPT_TIMEOUT_MS] = 2000;
        }
        $reqHeaderArr = [];
        foreach ($this->reqHeader as $headerKey => $headerVal) {
            $reqHeaderArr[] = $headerKey . ': ' . $headerVal;
        }
        $this->curlConfigs[CURLOPT_HTTPHEADER] = $reqHeaderArr;
        return $this->curlConfigs;
    }
}
