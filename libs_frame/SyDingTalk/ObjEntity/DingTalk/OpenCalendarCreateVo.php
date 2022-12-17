<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 创建日程实体
 *
 * @author auto create
 */
class OpenCalendarCreateVo
{
    /**
     * 业务方自己的主键
     */
    public $biz_id;

    /**
     * 日程类型:task-任务;meeting-会议;notification-提醒
     */
    public $calendar_type;

    /**
     * 创建者工号
     */
    public $creator_userid;

    /**
     * 备注
     */
    public $description;

    /**
     * 结束时间
     */
    public $end_time;

    /**
     * 地点
     */
    public $location;

    /**
     * 接收者工号
     */
    public $receiver_userids;

    /**
     * 事项开始前提醒
     */
    public $reminder;

    /**
     * 显示日程来源
     */
    public $source;

    /**
     * 开始时间
     */
    public $start_time;

    /**
     * 主题
     */
    public $summary;

    /**
     * 请求的唯一标识, 保证请求唯一性
     */
    public $uuid;
}
