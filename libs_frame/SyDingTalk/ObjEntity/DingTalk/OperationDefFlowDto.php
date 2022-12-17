<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 工序定义图
 *
 * @author auto create
 */
class OperationDefFlowDto
{
    /**
     * 是否激活/最大版本
     */
    public $active;

    /**
     * 工序定义版本
     */
    public $flow_version;

    /**
     * 工序定义列表
     */
    public $operation_defs;

    /**
     * 订单ID
     */
    public $order_id;

    /**
     * 来源系统
     */
    public $source;

    /**
     * 租户ID
     */
    public $tenant_id;
}
