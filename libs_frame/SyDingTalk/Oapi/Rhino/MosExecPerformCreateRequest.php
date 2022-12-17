<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.exec.perform.create request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.20
 */
class MosExecPerformCreateRequest extends BaseRequest
{
    /**
     * 工序执行记录
     */
    private $operations;
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

    public function setOperations($operations)
    {
        $this->operations = $operations;
        $this->apiParas['operations'] = $operations;
    }

    public function getOperations()
    {
        return $this->operations;
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
        return 'dingtalk.oapi.rhino.mos.exec.perform.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->tenantId, 'tenantId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
