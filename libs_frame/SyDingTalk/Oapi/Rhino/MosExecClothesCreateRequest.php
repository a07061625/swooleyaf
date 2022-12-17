<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.exec.clothes.create request
 *
 * @author auto create
 *
 * @since 1.0, 2020.04.20
 */
class MosExecClothesCreateRequest extends BaseRequest
{
    /**
     * 工序信息
     */
    private $additionalOperations;
    /**
     * 衣服状态是否自动开启
     */
    private $autoStart;
    /**
     * 业务类型
     */
    private $bizType;
    /**
     * 衣服详情
     */
    private $clothes;
    /**
     * 实体类型
     */
    private $entityType;
    /**
     * 订单ID
     */
    private $orderId;
    /**
     * 来源
     */
    private $source;
    /**
     * 租户ID
     */
    private $tenantId;
    /**
     * 业务参数[这里先预留],这里是用户ID,比如钉钉用户ID
     */
    private $userid;

    public function setAdditionalOperations($additionalOperations)
    {
        $this->additionalOperations = $additionalOperations;
        $this->apiParas['additional_operations'] = $additionalOperations;
    }

    public function getAdditionalOperations()
    {
        return $this->additionalOperations;
    }

    public function setAutoStart($autoStart)
    {
        $this->autoStart = $autoStart;
        $this->apiParas['auto_start'] = $autoStart;
    }

    public function getAutoStart()
    {
        return $this->autoStart;
    }

    public function setBizType($bizType)
    {
        $this->bizType = $bizType;
        $this->apiParas['biz_type'] = $bizType;
    }

    public function getBizType()
    {
        return $this->bizType;
    }

    public function setClothes($clothes)
    {
        $this->clothes = $clothes;
        $this->apiParas['clothes'] = $clothes;
    }

    public function getClothes()
    {
        return $this->clothes;
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
        return 'dingtalk.oapi.rhino.mos.exec.clothes.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->entityType, 'entityType');
        RequestCheckUtil::checkNotNull($this->orderId, 'orderId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
