<?php
/**
 * 获取当前账单月内使用量
 * User: 姜伟
 * Date: 2019/7/17 0017
 * Time: 17:14
 */
namespace SyIot\BaiDu\Usage;

use SyIot\IotBaseBaiDu;
use SyIot\IotUtilBaiDu;

class UsageAccount extends IotBaseBaiDu
{
    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/v1/usage';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        $this->reqHeader['Authorization'] = IotUtilBaiDu::createSign([
            'req_method' => self::REQ_METHOD_GET,
            'req_uri' => $this->serviceUri,
            'req_params' => [],
            'req_headers' => [
                'host',
            ],
        ]);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceProtocol . '://' . $this->serviceDomain . $this->serviceUri;
        return $this->getContent();
    }
}
