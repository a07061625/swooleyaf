<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请假状态列表
 *
 * @author auto create
 */
class LeaveStatusVO
{
    /**
     * 假期时长*100，例如用户请假时长为1天，该值就等于100
     */
    public $duration_percent;

    /**
     * 请假单位：“percent_day”表示天，“percent_hour”表示小时
     */
    public $duration_unit;

    /**
     * 请假结束时间，时间戳
     */
    public $end_time;

    /**
     * 假期类型code
     */
    public $leave_code;

    /**
     * 请假开始时间，时间戳
     */
    public $start_time;

    /**
     * 用户id
     */
    public $userid;
}
