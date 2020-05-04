<?php
/**
 * 获取平台证书列表
 * User: 姜伟
 * Date: 2020/5/4 0004
 * Time: 15:09
 */
namespace Wx\Payment\V3;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyTool\Tool;
use Wx\WxBasePayment;
use Wx\WxUtilBase;
use Wx\WxUtilPayment;

/**
 * Class CertList
 * @package Wx\Payment\V3
 */
class CertList extends WxBasePayment
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 商户号
     * @var string
     */
    private $mch_id = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/v3/certificates';
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($this->appid);

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [
            'Authorization: WECHATPAY2-SHA256-RSA2048 ' . WxUtilPayment::createV3Token([
                'request_method' => 'GET',
                'request_url' => $this->serviceUrl,
                'timestamp' => Tool::getNowTime(),
                'nonce' => Tool::createNonceStr(32),
                'body' => '',
                'mch_private_key' => $accountConfig->getSslKey(),
                'merchant_id' => $accountConfig->getPayMchId(),
                'serial_no' => $accountConfig->getSslSerialNo(),
            ]),
            'Accept: application/json',
            'User-Agent: ' . $accountConfig->getPayMchId(),
        ];
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);

        return [
            'code' => 0,
            'data' => Tool::jsonDecode($sendRes),
        ];
    }
}
