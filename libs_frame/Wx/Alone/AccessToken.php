<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 9:48
 */

namespace Wx\Alone;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAlone;
use Wx\WxUtilBase;

class AccessToken extends WxBaseAlone
{
    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/token';
        $accountConfig = WxConfigSingleton::getInstance()->getAccountConfig($appId);
        $this->reqData['appid'] = $accountConfig->getAppId();
        $this->reqData['secret'] = $accountConfig->getSecret();
        $this->reqData['grant_type'] = 'client_credential';
    }

    public function __clone()
    {
        //do nothing
    }

    public function getDetail(): array
    {
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . http_build_query($this->reqData);
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (!\is_array($sendData)) {
            throw new WxException('获取access token出错', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($sendData['access_token'])) {
            throw new WxException($sendData['errmsg'], ErrorCode::WX_PARAM_ERROR);
        }

        return $sendData;
    }
}
