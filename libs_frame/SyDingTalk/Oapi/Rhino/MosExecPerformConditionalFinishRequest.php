<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.exec.perform.conditional.finish request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.03
 */
class MosExecPerformConditionalFinishRequest extends BaseRequest
{
    /**
     * 执行设备ID列表
     */
    private $deviceIds;
    /**
     * 实体条件
     */
    private $entityCondition;
    /**
     * 工序ID列表
     */
    private $operationUids;
    /**
     * 订单ID
     */
    private $orderId;
    /**
     * 租户ID
     */
    private $tenantId;
    /**
     * 系统参数
     */
    private $userid;
    /**
     * 执行员工列表
     */
    private $workNos;

    public function setDeviceIds($deviceIds)
    {
        $this->deviceIds = $deviceIds;
        $this->apiParas['device_ids'] = $deviceIds;
    }

    public function getDeviceIds()
    {
        return $this->deviceIds;
    }

    public function setEntityCondition($entityCondition)
    {
        $this->entityCondition = $entityCondition;
        $this->apiParas['entity_condition'] = $entityCondition;
    }

    public function getEntityCondition()
    {
        return $this->entityCondition;
    }

    public function setOperationUids($operationUids)
    {
        $this->operationUids = $operationUids;
        $this->apiParas['operation_uids'] = $operationUids;
    }

    public function getOperationUids()
    {
        return $this->operationUids;
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

    public function setWorkNos($workNos)
    {
        $this->workNos = $workNos;
        $this->apiParas['work_nos'] = $workNos;
    }

    public function getWorkNos()
    {
        return $this->workNos;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.rhino.mos.exec.perform.conditional.finish';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->deviceIds, 20, 'deviceIds');
        RequestCheckUtil::checkMaxListSize($this->operationUids, 20, 'operationUids');
        RequestCheckUtil::checkNotNull($this->tenantId, 'tenantId');
        RequestCheckUtil::checkMaxListSize($this->workNos, 20, 'workNos');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
