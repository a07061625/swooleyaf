<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 入参
 *
 * @author auto create
 */
class SpecificEntityTypeWithTrackInfoReq
{
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
     * 追踪ID
     */
    public $track_ids;

    /**
     * 追踪类型
     */
    public $track_type;

    /**
     * 预留参数
     */
    public $userid;
}
