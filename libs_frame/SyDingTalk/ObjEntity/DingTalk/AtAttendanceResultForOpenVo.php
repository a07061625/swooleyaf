<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 打卡结果list
 *
 * @author auto create
 */
class AtAttendanceResultForOpenVo
{
    /**
     * 打卡类型 上班还是下班
     */
    public $check_type;

    /**
     * 班次id
     */
    public $class_id;

    /**
     * 考勤组id
     */
    public $group_id;

    /**
     * 定位方法
     */
    public $location_method;

    /**
     * 定位结果
     */
    public $location_result;

    /**
     * 外勤备注
     */
    public $outside_remark;

    /**
     * 标准打卡时间
     */
    public $plan_check_time;

    /**
     * 排班id
     */
    public $plan_id;

    /**
     * 审批单id
     */
    public $proc_inst_id;

    /**
     * 打卡流水id
     */
    public $record_id;

    /**
     * 打卡来源
     */
    public $source_type;

    /**
     * 打卡的时间结果
     */
    public $time_result;

    /**
     * 用户打卡地址
     */
    public $user_address;

    /**
     * 用户打卡时间
     */
    public $user_check_time;
}
