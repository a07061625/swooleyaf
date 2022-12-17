<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 回调失败数据列表
 *
 * @author auto create
 */
class FailedList
{
    /**
     * 回调数据。不同事件类型不同，通常为JSON String
     */
    public $call_back_data;

    /**
     * 事件类型
     */
    public $call_back_tag;

    /**
     * 企业id
     */
    public $corpid;

    /**
     * 失败时间。单位：毫秒
     */
    public $event_time;

    /**
     * 回调失败记录id
     */
    public $id;
}
