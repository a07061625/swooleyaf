<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 回放查询请求model
 *
 * @author auto create
 */
class PlayBackReqModel
{
    /**
     * 偏移量
     */
    public $end_time;

    /**
     * 页面大小
     */
    public $offset;

    /**
     * 直播结束时间
     */
    public $page_size;

    /**
     * 直播开始时间
     */
    public $start_time;
}
