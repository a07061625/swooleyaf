<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.layout.operationdef.activeflow request
 *
 * @author auto create
 *
 * @since 1.0, 2020.03.07
 */
class MosLayoutOperationDefActiveFlowRequest extends BaseRequest
{
    /**
     * 版本
     */
    private $flowVersion;
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

    public function setFlowVersion($flowVersion)
    {
        $this->flowVersion = $flowVersion;
        $this->apiParas['flow_version'] = $flowVersion;
    }

    public function getFlowVersion()
    {
        return $this->flowVersion;
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
        return 'dingtalk.oapi.rhino.mos.layout.operationdef.activeflow';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->flowVersion, 'flowVersion');
        RequestCheckUtil::checkNotNull($this->orderId, 'orderId');
        RequestCheckUtil::checkNotNull($this->tenantId, 'tenantId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
