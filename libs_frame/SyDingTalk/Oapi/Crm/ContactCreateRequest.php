<?php

namespace SyDingTalk\Oapi\Crm;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.crm.contact.create request
 *
 * @author auto create
 *
 * @since 1.0, 2022.04.12
 */
class ContactCreateRequest extends BaseRequest
{
    /**
     * 联系人姓名
     */
    private $contactName;
    /**
     * 联系人手机号
     */
    private $contactPhone;
    /**
     * 联系人职位
     */
    private $contactPositionList;
    /**
     * 创建人用户 ID
     */
    private $creatorUserid;
    /**
     * 所在客户实例 ID
     */
    private $customerInstanceId;
    /**
     * 服务商组织id, 特殊场景使用，丁税宝客户自建应用时传入对应的丁税宝服务商id用以生成 UnionId 关联自然人
     */
    private $providerCorpid;

    public function setContactName($contactName)
    {
        $this->contactName = $contactName;
        $this->apiParas['contact_name'] = $contactName;
    }

    public function getContactName()
    {
        return $this->contactName;
    }

    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;
        $this->apiParas['contact_phone'] = $contactPhone;
    }

    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    public function setContactPositionList($contactPositionList)
    {
        $this->contactPositionList = $contactPositionList;
        $this->apiParas['contact_position_list'] = $contactPositionList;
    }

    public function getContactPositionList()
    {
        return $this->contactPositionList;
    }

    public function setCreatorUserid($creatorUserid)
    {
        $this->creatorUserid = $creatorUserid;
        $this->apiParas['creator_userid'] = $creatorUserid;
    }

    public function getCreatorUserid()
    {
        return $this->creatorUserid;
    }

    public function setCustomerInstanceId($customerInstanceId)
    {
        $this->customerInstanceId = $customerInstanceId;
        $this->apiParas['customer_instance_id'] = $customerInstanceId;
    }

    public function getCustomerInstanceId()
    {
        return $this->customerInstanceId;
    }

    public function setProviderCorpid($providerCorpid)
    {
        $this->providerCorpid = $providerCorpid;
        $this->apiParas['provider_corpid'] = $providerCorpid;
    }

    public function getProviderCorpid()
    {
        return $this->providerCorpid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.crm.contact.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->contactName, 'contactName');
        RequestCheckUtil::checkMaxLength($this->contactName, 20, 'contactName');
        RequestCheckUtil::checkNotNull($this->contactPhone, 'contactPhone');
        RequestCheckUtil::checkMaxLength($this->contactPhone, 15, 'contactPhone');
        RequestCheckUtil::checkMaxListSize($this->contactPositionList, 999, 'contactPositionList');
        RequestCheckUtil::checkNotNull($this->creatorUserid, 'creatorUserid');
        RequestCheckUtil::checkNotNull($this->customerInstanceId, 'customerInstanceId');
        RequestCheckUtil::checkMaxLength($this->customerInstanceId, 50, 'customerInstanceId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
