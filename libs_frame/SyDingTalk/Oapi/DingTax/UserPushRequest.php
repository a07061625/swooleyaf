<?php

namespace SyDingTalk\Oapi\DingTax;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.dingtax.user.push request
 *
 * @author auto create
 *
 * @since 1.0, 2022.03.02
 */
class UserPushRequest extends BaseRequest
{
    /**
     * 运营区域
     */
    private $sourceRegion;
    /**
     * 运营数据
     */
    private $userInfoList;

    public function setSourceRegion($sourceRegion)
    {
        $this->sourceRegion = $sourceRegion;
        $this->apiParas['source_region'] = $sourceRegion;
    }

    public function getSourceRegion()
    {
        return $this->sourceRegion;
    }

    public function setUserInfoList($userInfoList)
    {
        $this->userInfoList = $userInfoList;
        $this->apiParas['user_info_list'] = $userInfoList;
    }

    public function getUserInfoList()
    {
        return $this->userInfoList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.dingtax.user.push';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->sourceRegion, 'sourceRegion');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
