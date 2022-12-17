<?php

namespace SyDingTalk\Oapi\User;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.user.senior.whitelist.set request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.15
 */
class SeniorWhiteListSetRequest extends BaseRequest
{
    /**
     * 高管白名单设置请求对象
     */
    private $seniorWhitelistRequest;

    public function setSeniorWhitelistRequest($seniorWhitelistRequest)
    {
        $this->seniorWhitelistRequest = $seniorWhitelistRequest;
        $this->apiParas['senior_whitelist_request'] = $seniorWhitelistRequest;
    }

    public function getSeniorWhitelistRequest()
    {
        return $this->seniorWhitelistRequest;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.user.senior.whitelist.set';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
