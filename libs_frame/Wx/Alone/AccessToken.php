<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 9:48
 */
namespace Wx\Alone;

use Constant\ErrorCode;
use DesignPatterns\Singletons\WxConfigSingleton;
use Exception\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseAlone;
use Wx\WxUtilBase;

class AccessToken extends WxBaseAlone {
    public function __construct(string $appId){
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/token';
        $shopConfig = WxConfigSingleton::getInstance()->getShopConfig($appId);
        $this->reqData['appid'] = $shopConfig->getAppId();
        $this->reqData['secret'] = $shopConfig->getSecret();
        $this->reqData['grant_type'] = 'client_credential';
    }

    public function __clone(){
    }

    public function getDetail() : array {
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . http_build_query($this->reqData);
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if(!is_array($sendData)){
            throw new WxException('获取access token出错', ErrorCode::WX_PARAM_ERROR);
        } else if(!isset($sendData['access_token'])){
            throw new WxException($sendData['errmsg'], ErrorCode::WX_PARAM_ERROR);
        }

        return $sendData;
    }
}