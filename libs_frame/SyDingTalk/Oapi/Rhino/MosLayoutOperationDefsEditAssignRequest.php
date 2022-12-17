<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.layout.operationdefs.editassign request
 *
 * @author auto create
 *
 * @since 1.0, 2020.03.23
 */
class MosLayoutOperationDefsEditAssignRequest extends BaseRequest
{
    /**
     * 分配信息修改明细列表
     */
    private $assignInfoModifyItems;
    /**
     * 订单ID
     */
    private $orderId;
    /**
     * 租户ID
     */
    private $tenantId;
    /**
     * 用户ID
     */
    private $userid;

    public function setAssignInfoModifyItems($assignInfoModifyItems)
    {
        $this->assignInfoModifyItems = $assignInfoModifyItems;
        $this->apiParas['assign_info_modify_items'] = $assignInfoModifyItems;
    }

    public function getAssignInfoModifyItems()
    {
        return $this->assignInfoModifyItems;
    }

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        $this->apiParas['order_id'] = $orderId;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function setTenantId($tenantId)
    {
        $this->tenantId = $tenantId;
        $this->apiParas['tenant_id'] = $tenantId;
    }

    public function getTenantId()
    {
        return $this->tenantId;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.rhino.mos.layout.operationdefs.editassign';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->orderId, 'orderId');
        RequestCheckUtil::checkNotNull($this->tenantId, 'tenantId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
