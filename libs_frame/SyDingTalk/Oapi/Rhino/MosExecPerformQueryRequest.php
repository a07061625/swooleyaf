<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.exec.perform.query request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.03
 */
class MosExecPerformQueryRequest extends BaseRequest
{
    /**
     * 生效条件
     */
    private $activeCondition;
    /**
     * 实体ID列表
     */
    private $entityIds;
    /**
     * 实体类型
     */
    private $entityType;
    /**
     * 工序列表
     */
    private $operationUids;
    /**
     * 订单ID
     */
    private $orderId;
    /**
     * 执行状态
     */
    private $performStatusList;
    /**
     * 租户ID
     */
    private $tenantId;
    /**
     * 业务参数[这里先预留],这里是用户ID,比如钉钉用户ID
     */
    private $userid;
    /**
     * 执行工位列表
     */
    private $workstationCodes;

    public function setActiveCondition($activeCondition)
    {
        $this->activeCondition = $activeCondition;
        $this->apiParas['active_condition'] = $activeCondition;
    }

    public function getActiveCondition()
    {
        return $this->activeCondition;
    }

    public function setEntityIds($entityIds)
    {
        $this->entityIds = $entityIds;
        $this->apiParas['entity_ids'] = $entityIds;
    }

    public function getEntityIds()
    {
        return $this->entityIds;
    }

    public function setEntityType($entityType)
    {
        $this->entityType = $entityType;
        $this->apiParas['entity_type'] = $entityType;
    }

    public function getEntityType()
    {
        return $this->entityType;
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

    public function setPerformStatusList($performStatusList)
    {
        $this->performStatusList = $performStatusList;
        $this->apiParas['perform_status_list'] = $performStatusList;
    }

    public function getPerformStatusList()
    {
        return $this->performStatusList;
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

    public function setWorkstationCodes($workstationCodes)
    {
        $this->workstationCodes = $workstationCodes;
        $this->apiParas['workstation_codes'] = $workstationCodes;
    }

    public function getWorkstationCodes()
    {
        return $this->workstationCodes;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.rhino.mos.exec.perform.query';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->entityIds, 500, 'entityIds');
        RequestCheckUtil::checkNotNull($this->entityType, 'entityType');
        RequestCheckUtil::checkMaxListSize($this->operationUids, 500, 'operationUids');
        RequestCheckUtil::checkMaxListSize($this->performStatusList, 20, 'performStatusList');
        RequestCheckUtil::checkNotNull($this->tenantId, 'tenantId');
        RequestCheckUtil::checkMaxListSize($this->workstationCodes, 20, 'workstationCodes');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
