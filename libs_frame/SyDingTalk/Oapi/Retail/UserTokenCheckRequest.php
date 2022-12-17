<?php

namespace SyDingTalk\Oapi\Retail;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.retail.user.token.check request
 *
 * @author auto create
 *
 * @since 1.0, 2020.03.09
 */
class UserTokenCheckRequest extends BaseRequest
{
    /**
     * 业务身份
     */
    private $channel;
    /**
     * token信息
     */
    private $token;

    public function setChannel($channel)
    {
        $this->channel = $channel;
        $this->apiParas['channel'] = $channel;
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function setToken($token)
    {
        $this->token = $token;
        $this->apiParas['token'] = $token;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.retail.user.token.check';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
