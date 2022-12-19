<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 8:52
 */

namespace Wx;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyTool\Tool;

abstract class WxBaseMerchantV3 extends WxBase
{
    const REQUEST_METHOD_GET = 'GET';
    const REQUEST_METHOD_POST = 'POST';
    const REQUEST_METHOD_PUT = 'PUT';
    const REQUEST_METHOD_DELETE = 'DELETE';
    /**
     * 商户号ID
     *
     * @var string
     */
    protected $appId = '';
    /**
     * 请求方式
     *
     * @var string
     */
    protected $reqMethod = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [];
        $this->appId = $appId;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    protected function setHeadAuth(): array
    {
        if (\in_array($this->reqMethod, [self::REQUEST_METHOD_POST, self::REQUEST_METHOD_PUT])) {
            $bodyStr = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        } else {
            $bodyStr = '';
        }

        $nowTime = Tool::getNowTime();
        $nonceStr = Tool::createNonceStr(32);
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($this->appId);
        $v3Token = WxUtilPayment::createV3Token([
            'request_method' => $this->reqMethod,
            'request_url' => $this->serviceUrl,
            'timestamp' => $nowTime,
            'nonce' => $nonceStr,
            'body' => $bodyStr,
            'mch_private_key' => $accountConfig->getSslKey(),
            'merchant_id' => $accountConfig->getPayMchId(),
            'serial_no' => $accountConfig->getV3SerialNo(),
        ]);
        array_push($this->curlConfigs[CURLOPT_HTTPHEADER], 'Authorization: WECHATPAY2-SHA256-RSA2048 ' . $v3Token);

        return [
            'now_time' => $nowTime,
            'nonce_tag' => $nonceStr,
        ];
    }
}
