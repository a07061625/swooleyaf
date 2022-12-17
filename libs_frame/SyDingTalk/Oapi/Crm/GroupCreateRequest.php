<?php

namespace SyDingTalk\Oapi\Crm;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.crm.group.create request
 *
 * @author auto create
 *
 * @since 1.0, 2022.04.25
 */
class GroupCreateRequest extends BaseRequest
{
    /**
     * 需要入群的同事userId列表
     */
    private $colleagueUseridList;
    /**
     * 联系人userId列表
     */
    private $contactIdList;
    /**
     * 客户归属的企业id
     */
    private $customerCorpid;
    /**
     * 客户id
     */
    private $customerId;
    /**
     * 群主userId
     */
    private $groupOwner;

    public function setColleagueUseridList($colleagueUseridList)
    {
        $this->colleagueUseridList = $colleagueUseridList;
        $this->apiParas['colleague_userid_list'] = $colleagueUseridList;
    }

    public function getColleagueUseridList()
    {
        return $this->colleagueUseridList;
    }

    public function setContactIdList($contactIdList)
    {
        $this->contactIdList = $contactIdList;
        $this->apiParas['contact_id_list'] = $contactIdList;
    }

    public function getContactIdList()
    {
        return $this->contactIdList;
    }

    public function setCustomerCorpid($customerCorpid)
    {
        $this->customerCorpid = $customerCorpid;
        $this->apiParas['customer_corpid'] = $customerCorpid;
    }

    public function getCustomerCorpid()
    {
        return $this->customerCorpid;
    }

    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
        $this->apiParas['customer_id'] = $customerId;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function setGroupOwner($groupOwner)
    {
        $this->groupOwner = $groupOwner;
        $this->apiParas['group_owner'] = $groupOwner;
    }

    public function getGroupOwner()
    {
        return $this->groupOwner;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.crm.group.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->colleagueUseridList, 20, 'colleagueUseridList');
        RequestCheckUtil::checkMaxListSize($this->contactIdList, 20, 'contactIdList');
        RequestCheckUtil::checkNotNull($this->customerCorpid, 'customerCorpid');
        RequestCheckUtil::checkNotNull($this->customerId, 'customerId');
        RequestCheckUtil::checkNotNull($this->groupOwner, 'groupOwner');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
