<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-12
 * Time: 上午1:32
 */
namespace Wx\Shop\Authorize;

use Constant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use Exception\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilBaseAlone;

class UserAuthorizeInfo extends WxBaseShop
{
    private $urlAccessToken = '';
    private $urlAuthorizeInfo = '';
    private $urlUserInfo = '';
    /**
     * 授权码
     * @var string
     */
    private $code = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->urlAccessToken = 'https://api.weixin.qq.com/sns/oauth2/access_token';
        $this->urlAuthorizeInfo = 'https://api.weixin.qq.com/sns/userinfo?lang=zh_CN&access_token=';
        $this->urlUserInfo = 'https://api.weixin.qq.com/cgi-bin/user/info?lang=zh_CN&access_token=';
        $shopConfig = WxConfigSingleton::getInstance()->getShopConfig($appId);
        $this->reqData['appid'] = $shopConfig->getAppId();
        $this->reqData['secret'] = $shopConfig->getSecret();
        $this->reqData['grant_type'] = 'authorization_code';
    }

    public function __clone()
    {
    }

    /**
     * @param string $code
     * @throws \Exception\Wx\WxException
     */
    public function setCode(string $code)
    {
        if (strlen($code) > 0) {
            $this->reqData['code'] = $code;
        } else {
            throw new WxException('授权码不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['code'])) {
            throw new WxException('授权码不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->urlAccessToken . '?' . http_build_query($this->reqData);
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (!isset($sendData['access_token'])) {
            $resArr['code'] = ErrorCode::WX_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
            return $resArr;
        }

        $openid = $sendData['openid'];
        $this->curlConfigs[CURLOPT_URL] = $this->urlAuthorizeInfo . $sendData['access_token'] . '&openid=' . $openid;
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['errcode']) && ($sendData['errcode'] == 40001)) {
            $this->curlConfigs[CURLOPT_URL] = $this->urlUserInfo . WxUtilBaseAlone::getAccessToken($this->reqData['appid']) . '&openid=' . $openid;
            $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
            $sendData = Tool::jsonDecode($sendRes);
        }

        if (isset($sendData['openid'])) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
