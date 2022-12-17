<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 行程费用
 *
 * @author auto create
 */
class BtripRoutes
{
    /**
     * 最低价
     */
    public $cheapest;

    /**
     * 出发时间
     */
    public $dep_date;

    /**
     * 目的地
     */
    public $dest_city;

    /**
     * 错误信息
     */
    public $err_msg;

    /**
     * 最高价
     */
    public $most_expensive;

    /**
     * 出发地
     */
    public $org_city;

    /**
     * 查询是否成功
     */
    public $success;
}
