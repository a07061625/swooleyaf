<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 11:44
 */
namespace Wx\Account\Tools;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;
use SyLog\Log;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class ShortUrl extends WxBaseAccount
{
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

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.mch.weixin.qq.com/tools/shorturl';
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->reqData['appid'] = $accountConfig->getAppId();
        $this->reqData['mch_id'] = $accountConfig->getPayMchId();
        $this->reqData['nonce_str'] = Tool::createNonceStr(32);
        $this->reqData['sign_type'] = 'MD5';
    }

    private function __clone()
    {
    }

    /**
     * @param string $longUrl
     * @throws \SyException\Wx\WxException
     */
    public function setLongUrl(string $longUrl)
    {
        if (preg_match('/^weixin/', $longUrl) > 0) {
            $this->reqData['long_url'] = $longUrl;
        } else {
            throw new WxException('长链接不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['long_url'])) {
            throw  new WxException('长链接不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['sign'] = WxUtilAccount::createSign($this->reqData, $this->reqData['appid']);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::arrayToXml($this->reqData);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::xmlToArray($sendRes);
        if ($sendData['return_code'] == 'FAIL') {
            Log::error($sendData['return_msg'], ErrorCode::WX_PARAM_ERROR);
            $url = $this->reqData['long_url'];
        } elseif ($sendData['result_code'] == 'FAIL') {
            $error = Tool::getArrayVal(WxUtilBase::$errorsShortUrl, $sendData['err_code'], $sendData['err_code_des']);
            Log::error($error, ErrorCode::WX_PARAM_ERROR);
            $url = $this->reqData['long_url'];
        } else {
            $url = $sendData['short_url'];
        }

        return [
            'url' => $url,
        ];
    }
}
