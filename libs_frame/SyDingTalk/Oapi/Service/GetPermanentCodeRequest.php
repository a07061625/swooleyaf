<?php

namespace SyDingTalk\Oapi\Service;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.service.get_permanent_code request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class GetPermanentCodeRequest extends BaseRequest
{
    /**
     * 回调接口（tmp_auth_code）获取的临时授权码
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
        return 'dingtalk.oapi.service.get_permanent_code';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
