<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 入参
 *
 * @author auto create
 */
class PageQueryClothesReq
{
    /**
     * 业务类型
     */
    public $biz_types;

    /**
     * 订单ID
     */
    public $order_id;

    /**
     * 分页
     */
    public $page;

    /**
     * 尺码CODE
     */
    public $size_code;

    /**
     * 来源
     */
    public $source;

    /**
     * 状态列表
     */
    public $status_list;

    /**
     * 租户ID
     */
    public $tenant_id;

    /**
     * 预留参数
     */
    public $userid;
}
