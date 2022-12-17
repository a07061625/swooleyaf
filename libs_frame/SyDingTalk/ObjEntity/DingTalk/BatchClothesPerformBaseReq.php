<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 入参
 *
 * @author auto create
 */
class BatchClothesPerformBaseReq
{
    /**
     * 实体列表
     */
    public $entity_ids;

    /**
     * 扩展属性
     */
    public $ext_properties;

    /**
     * 订单ID
     */
    public $order_id;

    /**
     * 租户id
     */
    public $tenant_id;

    /**
     * 用户id
     */
    public $userid;
}
