<?php

namespace SyDingTalk\Oapi\Sns;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.sns.get_sns_token request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class GetSnsTokenRequest extends BaseRequest
{
    /**
     * 用户的openid
     */
    private $openid;
    /**
     * 用户授权给钉钉开放应用的持久授权码
     */
    private $persistentCode;

    public function setOpenid($openid)
    {
        $this->openid = $openid;
        $this->apiParas['openid'] = $openid;
    }

    public function getOpenid()
    {
        return $this->openid;
    }

    public function setPersistentCode($persistentCode)
    {
        $this->persistentCode = $persistentCode;
        $this->apiParas['persistent_code'] = $persistentCode;
    }

    public function getPersistentCode()
    {
        return $this->persistentCode;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.sns.get_sns_token';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
