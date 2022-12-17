<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求提体
 *
 * @author auto create
 */
class OpenApiCustomOrderChangeReq
{
    /**
     * 2C订单id
     */
    public $biz_id_customer_order;

    /**
     * 2C订单状态
     */
    public $status;

    /**
     * 租户id
     */
    public $tenant_id;

    /**
     * 用户id
     */
    public $userid;
}
