<?php

namespace SyDingTalk\Oapi\CustomerService;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.customerservice.member.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.29
 */
class MemberGetRequest extends BaseRequest
{
    /**
     * 钉钉企业id
     */
    private $dingCorpId;
    /**
     * 实例id
     */
    private $openInstanceId;
    /**
     * 1，智能客服
     */
    private $productionType;
    /**
     * 三方租户id
     */
    private $thirdTenantId;
    /**
     * 账号id
     */
    private $userId;
    /**
     * 账号来源
     */
    private $userSourceId;

    public function setDingCorpId($dingCorpId)
    {
        $this->dingCorpId = $dingCorpId;
        $this->apiParas['ding_corp_id'] = $dingCorpId;
    }

    public function getDingCorpId()
    {
        return $this->dingCorpId;
    }

    public function setOpenInstanceId($openInstanceId)
    {
        $this->openInstanceId = $openInstanceId;
        $this->apiParas['open_instance_id'] = $openInstanceId;
    }

    public function getOpenInstanceId()
    {
        return $this->openInstanceId;
    }

    public function setProductionType($productionType)
    {
        $this->productionType = $productionType;
        $this->apiParas['production_type'] = $productionType;
    }

    public function getProductionType()
    {
        return $this->productionType;
    }

    public function setThirdTenantId($thirdTenantId)
    {
        $this->thirdTenantId = $thirdTenantId;
        $this->apiParas['third_tenant_id'] = $thirdTenantId;
    }

    public function getThirdTenantId()
    {
        return $this->thirdTenantId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        $this->apiParas['user_id'] = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserSourceId($userSourceId)
    {
        $this->userSourceId = $userSourceId;
        $this->apiParas['user_source_id'] = $userSourceId;
    }

    public function getUserSourceId()
    {
        return $this->userSourceId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.customerservice.member.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->thirdTenantId, 'thirdTenantId');
        RequestCheckUtil::checkNotNull($this->userId, 'userId');
        RequestCheckUtil::checkNotNull($this->userSourceId, 'userSourceId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
