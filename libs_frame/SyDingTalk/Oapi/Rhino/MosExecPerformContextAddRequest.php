<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.exec.perform.context.add request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.22
 */
class MosExecPerformContextAddRequest extends BaseRequest
{
    /**
     * 上下文
     */
    private $context;
    /**
     * 工序执行记录ID列表
     */
    private $operationRecordIds;
    /**
     * 订单ID
     */
    private $orderId;
    /**
     * 租户ID
     */
    private $tenantId;
    /**
     * 业务参数，先预留ID
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

    public function setOperationRecordIds($operationRecordIds)
    {
        $this->operationRecordIds = $operationRecordIds;
        $this->apiParas['operation_record_ids'] = $operationRecordIds;
    }

    public function getOperationRecordIds()
    {
        return $this->operationRecordIds;
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
        return 'dingtalk.oapi.rhino.mos.exec.perform.context.add';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->context, 'context');
        RequestCheckUtil::checkNotNull($this->operationRecordIds, 'operationRecordIds');
        RequestCheckUtil::checkMaxListSize($this->operationRecordIds, 100, 'operationRecordIds');
        RequestCheckUtil::checkNotNull($this->tenantId, 'tenantId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
