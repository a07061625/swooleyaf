<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 打卡事件列表
 *
 * @author auto create
 */
class UserEventOapiVo
{
    /**
     * 打卡业务实例id
     */
    public $biz_inst_id;

    /**
     * 打卡事件开始时间，单位毫秒
     */
    public $end_time;

    /**
     * 打卡事件外部id，唯一键
     */
    public $event_id;

    /**
     * 打卡事件名称
     */
    public $event_name;

    /**
     * 打卡事件生成时间戳，单位毫秒
     */
    public $event_time_stamp;

    /**
     * 位置列表
     */
    public $position_list;

    /**
     * 打卡事件结束时间，单位毫秒
     */
    public $start_time;

    /**
     * 员工id
     */
    public $userid;
}
