<?php
/**
 * 获取平台证书列表
 * User: 姜伟
 * Date: 2020/5/4 0004
 * Time: 15:09
 */

namespace Wx\Merchant\V3\Certs;

use DesignPatterns\Singletons\WxConfigSingleton;
use Wx\WxBaseMerchantV3;
use Wx\WxUtilBase;

/**
 * Class CertList
 *
 * @package Wx\Payment\V3\Certs
 */
class CertList extends WxBaseMerchantV3
{
    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/v3/certificates';
        $this->reqMethod = self::REQUEST_METHOD_GET;
        array_push($this->curlConfigs[CURLOPT_HTTPHEADER], 'Accept: application/json');
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Wx\WxException
     */
    public function getDetail(): array
    {
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->setHeadAuth();

        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($this->appId);
        array_push($this->curlConfigs[CURLOPT_HTTPHEADER], 'User-Agent: ' . $accountConfig->getPayMchId());
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs, 2);

        return $this->handleRespJson($sendRes);
    }
}
