<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.exec.track.bind request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.16
 */
class MosExecTrackBindRequest extends BaseRequest
{
    /**
     * 实体ID列表
     */
    private $entities;
    /**
     * 实体类型
     */
    private $entityType;
    /**
     * 订单ID
     */
    private $orderId;
    /**
     * 租户ID
     */
    private $tenantId;
    /**
     * 追踪ID
     */
    private $trackId;
    /**
     * 追踪类型，吊挂或才RF
     */
    private $trackType;
    /**
     * 系统参数
     */
    private $userid;
    /**
     * 工位
     */
    private $workstationCode;

    public function setEntities($entities)
    {
        $this->entities = $entities;
        $this->apiParas['entities'] = $entities;
    }

    public function getEntities()
    {
        return $this->entities;
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

    public function setTrackId($trackId)
    {
        $this->trackId = $trackId;
        $this->apiParas['track_id'] = $trackId;
    }

    public function getTrackId()
    {
        return $this->trackId;
    }

    public function setTrackType($trackType)
    {
        $this->trackType = $trackType;
        $this->apiParas['track_type'] = $trackType;
    }

    public function getTrackType()
    {
        return $this->trackType;
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

    public function setWorkstationCode($workstationCode)
    {
        $this->workstationCode = $workstationCode;
        $this->apiParas['workstation_code'] = $workstationCode;
    }

    public function getWorkstationCode()
    {
        return $this->workstationCode;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.rhino.mos.exec.track.bind';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->entities, 'entities');
        RequestCheckUtil::checkMaxListSize($this->entities, 500, 'entities');
        RequestCheckUtil::checkNotNull($this->entityType, 'entityType');
        RequestCheckUtil::checkNotNull($this->tenantId, 'tenantId');
        RequestCheckUtil::checkNotNull($this->trackId, 'trackId');
        RequestCheckUtil::checkNotNull($this->trackType, 'trackType');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
