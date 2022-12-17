<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 接口返回model
 *
 * @author auto create
 */
class Module
{
    /**
     * 酒店差标
     */
    public $hotel_fee_detail;

    /**
     * 异步查询key。需要client再次尝试请求
     */
    public $query_key;

    /**
     * 费用
     */
    public $traffic_fee;
}
