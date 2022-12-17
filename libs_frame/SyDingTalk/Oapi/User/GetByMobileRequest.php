<?php

namespace SyDingTalk\Oapi\User;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.user.get_by_mobile request
 *
 * @author auto create
 *
 * @since 1.0, 2019.10.11
 */
class GetByMobileRequest extends BaseRequest
{
    /**
     * 手机号
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
        return 'dingtalk.oapi.user.get_by_mobile';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->mobile, 'mobile');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
