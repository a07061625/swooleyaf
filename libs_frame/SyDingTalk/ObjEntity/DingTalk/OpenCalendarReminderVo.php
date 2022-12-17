<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 会议开始前提醒
 *
 * @author auto create
 */
class OpenCalendarReminderVo
{
    /**
     * 提醒方式.app表示应用内提醒
     */
    public $method;

    /**
     * 开始前提醒的分钟数,有效值为0，5，15，30，60，1440
     */
    public $minutes;
}
