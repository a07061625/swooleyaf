<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.exec.perform.rework request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.03
 */
class MosExecPerformReworkRequest extends BaseRequest
{
    /**
     * 执行上下文
     */
    private $context;
    /**
     * 订单ID
     */
    private $orderId;
    /**
     * 要重新开始的工序执行ID
     */
    private $reworkStartId;
    /**
     * 租户ID
     */
    private $tenantId;
    /**
     * 要失效的工序执行ID列表
     */
    private $toInactiveIds;
    /**
     * 系统参数
     */
    private $userid;

    public function setContext($context)
    {
        $this->context = $context;
        $this->apiParas['context'] = $context;
    }

    public function getContext()
    {
        return $this->context;
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

    public function setReworkStartId($reworkStartId)
    {
        $this->reworkStartId = $reworkStartId;
        $this->apiParas['rework_start_id'] = $reworkStartId;
    }

    public function getReworkStartId()
    {
        return $this->reworkStartId;
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

    public function setToInactiveIds($toInactiveIds)
    {
        $this->toInactiveIds = $toInactiveIds;
        $this->apiParas['to_inactive_ids'] = $toInactiveIds;
    }

    public function getToInactiveIds()
    {
        return $this->toInactiveIds;
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
        return 'dingtalk.oapi.rhino.mos.exec.perform.rework';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->reworkStartId, 'reworkStartId');
        RequestCheckUtil::checkNotNull($this->tenantId, 'tenantId');
        RequestCheckUtil::checkNotNull($this->toInactiveIds, 'toInactiveIds');
        RequestCheckUtil::checkMaxListSize($this->toInactiveIds, 500, 'toInactiveIds');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
