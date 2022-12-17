<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 入参
 *
 * @author auto create
 */
class GetUnPerformedClothesByOperationReq
{
    /**
     * 业务类型
     */
    public $biz_types;

    /**
     * 工序id
     */
    public $operation_uids;

    /**
     * 订单id
     */
    public $order_id;

    /**
     * 分页
     */
    public $page;

    /**
     * 尺码信息
     */
    public $size_code;

    /**
     * 状态
     */
    public $status;

    /**
     * 租户id
     */
    public $tenant_id;

    /**
     * userId
     */
    public $userid;
}
