<?php

namespace SyDingTalk\Oapi\Sns;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.sns.getuserinfo request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class GetUserInfoRequest extends BaseRequest
{
    /**
     * 用户授权给开放应用的token
     */
    private $snsToken;

    public function setSnsToken($snsToken)
    {
        $this->snsToken = $snsToken;
        $this->apiParas['sns_token'] = $snsToken;
    }

    public function getSnsToken()
    {
        return $this->snsToken;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.sns.getuserinfo';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
