<?php

namespace SyDingTalk\Oapi\Org;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.org.userteaminvite.accept request
 *
 * @author auto create
 *
 * @since 1.0, 2021.02.24
 */
class UserTeamInviteAcceptRequest extends BaseRequest
{
    /**
     * 手机号
     */
    private $mobile;
    /**
     * 国家码
     */
    private $stateCode;

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        $this->apiParas['mobile'] = $mobile;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function setStateCode($stateCode)
    {
        $this->stateCode = $stateCode;
        $this->apiParas['state_code'] = $stateCode;
    }

    public function getStateCode()
    {
        return $this->stateCode;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.org.userteaminvite.accept';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->mobile, 'mobile');
        RequestCheckUtil::checkNotNull($this->stateCode, 'stateCode');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
