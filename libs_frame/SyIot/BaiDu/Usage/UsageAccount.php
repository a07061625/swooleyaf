<?php
/**
 * 获取当前账单月内使用量
 * User: 姜伟
 * Date: 2019/7/17 0017
 * Time: 17:14
 */
namespace SyIot\BaiDu\Usage;

use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;

class UsageAccount extends BaseBaiDu
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
        $this->reqHeader['Authorization'] = UtilBaiDu::createSign([
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
