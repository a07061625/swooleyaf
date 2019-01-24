<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 11:44
 */
namespace Wx\Shop\Tools;

use Constant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use Exception\Wx\WxException;
use Log\Log;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class ShortUrl extends WxBaseShop {
    /**
     * 商户号
     * @var string
     */
    private $mch_id = '';
    /**
     * URL链接
     * @var string
     */
    private $long_url = '';
    /**
     * 随机字符串
     * @var string
     */
    private $nonce_str = '';
    /**
     * 签名类型
     * @var string
     */
    private $sign_type = '';

    public function __construct(string $appId) {
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/tools/shorturl';
        $shopConfig = WxConfigSingleton::getInstance()->getShopConfig($appId);
        $this->reqData['appid'] = $shopConfig->getAppId();
        $this->reqData['mch_id'] = $shopConfig->getPayMchId();
        $this->reqData['nonce_str'] = Tool::createNonceStr(32);
        $this->reqData['sign_type'] = 'MD5';
    }

    private function __clone(){
    }

    /**
     * @param string $longUrl
     * @throws \Exception\Wx\WxException
     */
    public function setLongUrl(string $longUrl) {
        if (preg_match('/^weixin/', $longUrl) > 0) {
            $this->reqData['long_url'] = $longUrl;
        } else {
            throw new WxException('长链接不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(!isset($this->reqData['long_url'])){
            throw  new WxException('长链接不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['sign'] = WxUtilShop::createSign($this->reqData, $this->reqData['appid']);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::arrayToXml($this->reqData);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::xmlToArray($sendRes);
        if ($sendData['return_code'] == 'FAIL') {
            Log::error($sendData['return_msg'], ErrorCode::WX_PARAM_ERROR);
            $url = WxUtilBase::URL_QRCODE . urlencode($this->reqData['long_url']);
        } else if ($sendData['result_code'] == 'FAIL') {
            $error = Tool::getArrayVal(WxUtilBase::$errorsShortUrl, $sendData['err_code'], $sendData['err_code_des']);
            Log::error($error, ErrorCode::WX_PARAM_ERROR);
            $url = WxUtilBase::URL_QRCODE . urlencode($this->reqData['long_url']);
        } else {
            $url = WxUtilBase::URL_QRCODE . urlencode($sendData['short_url']);
        }

        return [
            'url' => $url,
        ];
    }
}