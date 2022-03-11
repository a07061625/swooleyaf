<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 9:48
 */

namespace Wx\Corp\Common;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseCorp;
use Wx\WxUtilBase;

class AccessToken extends WxBaseCorp
{
    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/gettoken';
        $cropConfig = WxConfigSingleton::getInstance()->getCorpConfig($corpId);
        $agentInfo = $cropConfig->getAgentInfo($agentTag);
        $this->reqData['corpid'] = $cropConfig->getCorpId();
        $this->reqData['corpsecret'] = $agentInfo['secret'];
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
