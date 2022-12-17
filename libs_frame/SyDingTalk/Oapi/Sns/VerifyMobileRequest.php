<?php

namespace SyDingTalk\Oapi\Sns;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.sns.verify_mobile request
 *
 * @author auto create
 *
 * @since 1.0, 2019.12.30
 */
class VerifyMobileRequest extends BaseRequest
{
    /**
     * 1
     */
    private $mobile;

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        $this->apiParas['mobile'] = $mobile;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.sns.verify_mobile';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
