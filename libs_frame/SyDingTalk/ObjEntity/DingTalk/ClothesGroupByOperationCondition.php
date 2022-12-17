<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求参数
 *
 * @author auto create
 */
class ClothesGroupByOperationCondition
{
    /**
     * 工序生效条件(ACTIVE/INACTIVE)
     */
    public $active_condition;

    /**
     * 衣服生产状态列表
     */
    public $clothes_status_list;

    /**
     * 订单ID
     */
    public $order_id;

    /**
     * 工序执行状态
     */
    public $perform_status_list;

    /**
     * 租户ID
     */
    public $tenant_id;

    /**
     * userid
     */
    public $userid;
}
