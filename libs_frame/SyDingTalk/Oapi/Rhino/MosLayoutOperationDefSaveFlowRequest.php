<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.layout.operationdef.saveflow request
 *
 * @author auto create
 *
 * @since 1.0, 2020.04.09
 */
class MosLayoutOperationDefSaveFlowRequest extends BaseRequest
{
    /**
     * 是否生效
     */
    private $active;
    /**
     * 工序版本(指定版本时版本如果已经存在则幂等)
     */
    private $flowVersion;
    /**
     * 工序定义列表
     */
    private $operationDefs;
    /**
     * 订单ID
     */
    private $orderId;
    /**
     * 来源系统
     */
    private $source;
    /**
     * 租户ID
     */
    private $tenantId;
    /**
     * 是否暂存
     */
    private $tmpSave;
    /**
     * 用户ID
     */
    private $userid;

    public function setActive($active)
    {
        $this->active = $active;
        $this->apiParas['active'] = $active;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setFlowVersion($flowVersion)
    {
        $this->flowVersion = $flowVersion;
        $this->apiParas['flow_version'] = $flowVersion;
    }

    public function getFlowVersion()
    {
        return $this->flowVersion;
    }

    public function setOperationDefs($operationDefs)
    {
        $this->operationDefs = $operationDefs;
        $this->apiParas['operation_defs'] = $operationDefs;
    }

    public function getOperationDefs()
    {
        return $this->operationDefs;
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

    public function setSource($source)
    {
        $this->source = $source;
        $this->apiParas['source'] = $source;
    }

    public function getSource()
    {
        return $this->source;
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
        return 'dingtalk.oapi.rhino.mos.layout.operationdef.saveflow';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->active, 'active');
        RequestCheckUtil::checkNotNull($this->orderId, 'orderId');
        RequestCheckUtil::checkNotNull($this->tenantId, 'tenantId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
