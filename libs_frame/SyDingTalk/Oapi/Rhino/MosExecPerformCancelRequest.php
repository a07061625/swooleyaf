<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.exec.perform.cancel request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.03
 */
class MosExecPerformCancelRequest extends BaseRequest
{
    /**
     * 执行上下文
     */
    private $context;
    /**
     * 工序执行记录ID列表
     */
    private $operationPerformRecordIds;
    /**
     * 订单ID
     */
    private $orderId;
    /**
     * 是否停止调度
     */
    private $stopSchedule;
    /**
     * 租户ID列表
     */
    private $tenantId;
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

    public function setOperationPerformRecordIds($operationPerformRecordIds)
    {
        $this->operationPerformRecordIds = $operationPerformRecordIds;
        $this->apiParas['operation_perform_record_ids'] = $operationPerformRecordIds;
    }

    public function getOperationPerformRecordIds()
    {
        return $this->operationPerformRecordIds;
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

    public function setStopSchedule($stopSchedule)
    {
        $this->stopSchedule = $stopSchedule;
        $this->apiParas['stop_schedule'] = $stopSchedule;
    }

    public function getStopSchedule()
    {
        return $this->stopSchedule;
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
        return 'dingtalk.oapi.rhino.mos.exec.perform.cancel';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->operationPerformRecordIds, 'operationPerformRecordIds');
        RequestCheckUtil::checkMaxListSize($this->operationPerformRecordIds, 500, 'operationPerformRecordIds');
        RequestCheckUtil::checkNotNull($this->tenantId, 'tenantId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
