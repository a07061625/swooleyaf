<?php

namespace SyDingTalk\Corp\Blazers;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.corp.blazers.removemapping request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class RemoveMappingRequest extends BaseRequest
{
    /**
     * 商户唯一标识
     */
    private $bizId;

    public function setBizId($bizId)
    {
        $this->bizId = $bizId;
        $this->apiParas['biz_id'] = $bizId;
    }

    public function getBizId()
    {
        return $this->bizId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.blazers.removemapping';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
