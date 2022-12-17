<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求对象
 *
 * @author auto create
 */
class OpenSearchRq
{
    /**
     * false:仅搜索未报销订单
     */
    public $all_apply;

    /**
     * 商旅审批单id
     */
    public $apply_id;

    /**
     * 企业id
     */
    public $corpid;

    /**
     * 部门id
     */
    public $deptid;

    /**
     * 创建结束时间
     */
    public $end_time;

    /**
     * 页数，从1开始
     */
    public $page;

    /**
     * 每页数量，默认10，最大50
     */
    public $page_size;

    /**
     * 创建开始时间
     */
    public $start_time;

    /**
     * 第三方申请单ID
     */
    public $thirdpart_apply_id;

    /**
     * 更新结束时间
     */
    public $update_end_time;

    /**
     * 更新开始时间
     */
    public $update_start_time;

    /**
     * 用户id
     */
    public $userid;
}
