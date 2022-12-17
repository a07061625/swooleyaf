<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 接收者状态列表，当这里返回为null表示分页已经结束
 *
 * @author auto create
 */
class DingReceiverStatusResult
{
    /**
     * 确认状态。0-未确认；1-已确认；
     */
    public $confirmed_status;

    /**
     * 确认时间
     */
    public $confirmed_time;

    /**
     * dingId
     */
    public $ding_id;

    /**
     * 接收者id
     */
    public $userid;
}
