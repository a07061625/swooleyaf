<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 巡店任务列表
 *
 * @author auto create
 */
class TopInspectTaskVo
{
    /**
     * 签到时间戳，单位毫秒
     */
    public $check_in_time;

    /**
     * 签退时间戳，单位毫秒
     */
    public $check_out_time;

    /**
     * 巡店时间，单位秒
     */
    public $duration;

    /**
     * 位置唯一标识，如果是B1等硬件设备则为设备唯一标识
     */
    public $position_id;

    /**
     * 位置名称
     */
    public $position_name;

    /**
     * 任务状态，1已签到，2已正常签退，3已异常签退
     */
    public $status;

    /**
     * 任务id 唯一标识一个任务
     */
    public $task_id;

    /**
     * 员工id
     */
    public $userid;

    /**
     * 工作日期时间戳，单位毫秒
     */
    public $work_date;
}
