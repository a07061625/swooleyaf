<?php

namespace SyDingTalk\Oapi\V2User;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.v2.user.getuserinfo request
 *
 * @author auto create
 *
 * @since 1.0, 2022.04.11
 */
class GetUserInfoRequest extends BaseRequest
{
    /**
     * 免登授权码
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
        return 'dingtalk.oapi.v2.user.getuserinfo';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->code, 'code');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
