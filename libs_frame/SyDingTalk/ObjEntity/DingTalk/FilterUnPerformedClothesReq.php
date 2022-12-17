<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 入参
 *
 * @author auto create
 */
class FilterUnPerformedClothesReq
{
    /**
     * 实体ID列表
     */
    public $entity_ids;

    /**
     * 工序ID列表
     */
    public $operation_uids;

    /**
     * 订单ID
     */
    public $order_id;

    /**
     * 租户ID
     */
    public $tenant_id;

    /**
     * 预留参数
     */
    public $userid;
}
