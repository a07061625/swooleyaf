<?php

namespace SyDingTalk\Oapi\Sns;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.sns.getuserinfo_bycode request
 *
 * @author auto create
 *
 * @since 1.0, 2022.04.12
 */
class GetUserInfoByCodeRequest extends BaseRequest
{
    /**
     * 登录的临时授权码
     */
    private $tmpAuthCode;

    public function setTmpAuthCode($tmpAuthCode)
    {
        $this->tmpAuthCode = $tmpAuthCode;
        $this->apiParas['tmp_auth_code'] = $tmpAuthCode;
    }

    public function getTmpAuthCode()
    {
        return $this->tmpAuthCode;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.sns.getuserinfo_bycode';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
