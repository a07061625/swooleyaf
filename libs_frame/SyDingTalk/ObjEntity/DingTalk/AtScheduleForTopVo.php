<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 排班列表
 *
 * @author auto create
 */
class AtScheduleForTopVo
{
    /**
     * 审批id,结果集中没有的话表示没有审批单
     */
    public $approve_id;

    /**
     * 打卡类型，Onduty表示上班打卡，OffDuty表示下班打卡
     */
    public $check_type;

    /**
     * 考勤班次id
     */
    public $class_id;

    /**
     * 班次配置id，结果集中没有的话表示使用全局班次配置
     */
    public $class_setting_id;

    /**
     * 考勤组id
     */
    public $group_id;

    /**
     * 打卡时间
     */
    public $plan_check_time;

    /**
     * 排班id
     */
    public $plan_id;

    /**
     * userId
     */
    public $userid;
}
