<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求入参
 *
 * @author auto create
 */
class OpenApiIntervalPriceRq
{
    /**
     * 类目flight\hotel\train
     */
    public $category;

    /**
     * 企业id
     */
    public $corpid;

    /**
     * 返程时间
     */
    public $end_time;

    /**
     * 从哪里出发
     */
    public $from_where;

    /**
     * 行程id
     */
    public $itinerary_id;

    /**
     * 根据key查询
     */
    public $query_key;

    /**
     * 出发时间
     */
    public $start_time;

    /**
     * 目的地
     */
    public $to_where;

    /**
     * 钉用户id
     */
    public $userid;
}
