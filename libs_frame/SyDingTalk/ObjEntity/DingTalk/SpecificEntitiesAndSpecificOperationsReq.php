<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 入参
 *
 * @author auto create
 */
class SpecificEntitiesAndSpecificOperationsReq
{
    /**
     * 实体和工序
     */
    public $entity_operations;

    /**
     * 实体类型
     */
    public $entity_type;

    /**
     * 订单ID
     */
    public $order_id;

    /**
     * 租户ID
     */
    public $tenant_id;

    /**
     * 扩展参数
     */
    public $userid;
}
