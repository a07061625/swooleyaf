<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 入参
 *
 * @author auto create
 */
class BatchCreateOperationWithEntityReq
{
    /**
     * 实体条件
     */
    public $entity_condition;

    /**
     * 订单id
     */
    public $order_id;

    /**
     * 工序请求
     */
    public $perform_operation_reqs;

    /**
     * 来源
     */
    public $source;

    /**
     * 租户id
     */
    public $tenant_id;

    /**
     * 用户id
     */
    public $userid;
}
