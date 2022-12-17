<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求体
 *
 * @author auto create
 */
class OpenApiQueryProductOrderReq
{
    /**
     * 搜索字段
     */
    public $key_word;

    /**
     * 分页字段，页数
     */
    public $page;

    /**
     * 分页字段，默认分页大小
     */
    public $page_size;

    /**
     * 计划开始时间-查询结束时间
     */
    public $plan_time_begin;

    /**
     * 计划开始时间-查询结束时间
     */
    public $plan_time_end;

    /**
     * 排序字段
     */
    public $sort;

    /**
     * 是否顺序排序
     */
    public $sort_asc;

    /**
     * 状态列表
     */
    public $status_list;

    /**
     * 租户id
     */
    public $tenant_id;

    /**
     * 用户id
     */
    public $userid;
}
