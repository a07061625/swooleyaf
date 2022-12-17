<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.layout.operationdefs.next request
 *
 * @author auto create
 *
 * @since 1.0, 2020.04.09
 */
class MosLayoutOperationDefsNextRequest extends BaseRequest
{
    /**
     * 版本：如果为空，查生效版本；不为空，查指定版本
     */
    private $flowVersion;
    /**
     * 是否需要分配信息
     */
    private $needAssignInfo;
    /**
     * 外部工序ID，和工序唯一ID不能同时为空
     */
    private $operationExternalId;
    /**
     * 工序唯一ID
     */
    private $operationUid;
    /**
     * 订单ID
     */
    private $orderId;
    /**
     * 租户ID
     */
    private $tenantId;
    /**
     * 查询暂存版本
     */
    private $tmpSave;
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

    public function setNeedAssignInfo($needAssignInfo)
    {
        $this->needAssignInfo = $needAssignInfo;
        $this->apiParas['need_assign_info'] = $needAssignInfo;
    }

    public function getNeedAssignInfo()
    {
        return $this->needAssignInfo;
    }

    public function setOperationExternalId($operationExternalId)
    {
        $this->operationExternalId = $operationExternalId;
        $this->apiParas['operation_external_id'] = $operationExternalId;
    }

    public function getOperationExternalId()
    {
        return $this->operationExternalId;
    }

    public function setOperationUid($operationUid)
    {
        $this->operationUid = $operationUid;
        $this->apiParas['operation_uid'] = $operationUid;
    }

    public function getOperationUid()
    {
        return $this->operationUid;
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

    public function setTmpSave($tmpSave)
    {
        $this->tmpSave = $tmpSave;
        $this->apiParas['tmp_save'] = $tmpSave;
    }

    public function getTmpSave()
    {
        return $this->tmpSave;
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
        return 'dingtalk.oapi.rhino.mos.layout.operationdefs.next';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->needAssignInfo, 'needAssignInfo');
        RequestCheckUtil::checkNotNull($this->orderId, 'orderId');
        RequestCheckUtil::checkNotNull($this->tenantId, 'tenantId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
