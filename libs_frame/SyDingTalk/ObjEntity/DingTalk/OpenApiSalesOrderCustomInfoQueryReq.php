<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求体
 *
 * @author auto create
 */
class OpenApiSalesOrderCustomInfoQueryReq
{
    /**
     * 同步的2C订单批次id
     */
    public $batch_id;

    /**
     * 页码
     */
    public $page;

    /**
     * 每页大小
     */
    public $page_size;

    /**
     * 计划交期-查询时间开始
     */
    public $planned_delivery_time_begin;

    /**
     * 计划交期-查询时间结束
     */
    public $planned_delivery_time_end;

    /**
     * 生产订单id
     */
    public $product_order_id;

    /**
     * 租户id
     */
    public $tenant_id;

    /**
     * 用户id
     */
    public $userid;
}
