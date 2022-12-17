<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求体
 *
 * @author auto create
 */
class OpenApiBatchGetProductOrderReq
{
    /**
     * 订单id列表
     */
    public $id_list;

    /**
     * 租户Id
     */
    public $tenant_id;

    /**
     * 用户id
     */
    public $userid;
}
