<?php

namespace SyDingTalk\Oapi\User;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.user.getuserinfo request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class GetUserInfoRequest extends BaseRequest
{
    /**
     * requestAuthCode接口中获取的CODE
     */
    private $code;

    public function setCode($code)
    {
        $this->code = $code;
        $this->apiParas['code'] = $code;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.user.getuserinfo';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
