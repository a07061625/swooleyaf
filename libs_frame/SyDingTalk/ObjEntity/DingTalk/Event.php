<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 日程创建对象
 *
 * @author auto create
 */
class Event
{
    /**
     * 日程参与者，参与人数最多100人，包括组织者
     */
    public $attendees;

    /**
     * 日历ID,目前仅支持传primary,表示修改当前用户“我的日程”下的日程
     */
    public $calendar_id;

    /**
     * 日程描述
     */
    public $description;

    /**
     * 结束时间
     */
    public $end;

    /**
     * 日程Id
     */
    public $event_id;

    /**
     * 地址
     */
    public $location;

    /**
     * 日程组织者,暂不支持修改
     */
    public $organizer;

    /**
     * 会议开始前提醒
     */
    public $reminder;

    /**
     * 开始时间
     */
    public $start;

    /**
     * 日程主题
     */
    public $summary;
}
