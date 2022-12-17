<?php

namespace SyDingTalk\Oapi\V2User;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.v2.user.getbymobile request
 *
 * @author auto create
 *
 * @since 1.0, 2022.01.17
 */
class GetByMobileRequest extends BaseRequest
{
    /**
     * 手机号
     */
    private $mobile;
    /**
     * 支持通过手机号搜索专属帐号(不含其他组织创建的专属帐号)
     */
    private $supportExclusiveAccountSearch;

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        $this->apiParas['mobile'] = $mobile;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function setSupportExclusiveAccountSearch($supportExclusiveAccountSearch)
    {
        $this->supportExclusiveAccountSearch = $supportExclusiveAccountSearch;
        $this->apiParas['support_exclusive_account_search'] = $supportExclusiveAccountSearch;
    }

    public function getSupportExclusiveAccountSearch()
    {
        return $this->supportExclusiveAccountSearch;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.v2.user.getbymobile';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->mobile, 'mobile');
        RequestCheckUtil::checkMaxLength($this->mobile, 15, 'mobile');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
