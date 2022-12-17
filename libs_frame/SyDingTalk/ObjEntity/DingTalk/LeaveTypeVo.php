<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 业务结果
 *
 * @author auto create
 */
class LeaveTypeVo
{
    /**
     * 假期类型，普通假期或者加班转调休假期。(general_leave、lieu_leave其中一种)
     */
    public $biz_type;

    /**
     * 不需要余额控制的请假类型（如事假）
     */
    public $freedom_leave;

    /**
     * 每天折算的工作时长(百分之一 例如1天=10小时=1000)
     */
    public $hours_in_per_day;

    /**
     * 请假证明
     */
    public $leave_certificate;

    /**
     * 假期类型唯一标识
     */
    public $leave_code;

    /**
     * 请假取整up或者down
     */
    public $leave_hour_ceil;

    /**
     * 假期名称
     */
    public $leave_name;

    /**
     * 是否开启请假时长是否向上取整
     */
    public $leave_time_ceil;

    /**
     * 请假时长向上取整时的最小时长单位：hour-不足1小时按照1小时计算；halfHour-不足半小时按照半小时计算
     */
    public $leave_time_ceil_min_unit;

    /**
     * 请假单位，可以按照天半天或者小时请假。(day、halfDay、hour其中一种)
     */
    public $leave_view_unit;

    /**
     * 最大请假时长
     */
    public $max_leave_time;

    /**
     * 请假时，最小请假时长（请假单位为hour时生效），请假时长小于该值时自动取该值，有效值：[0, 23]
     */
    public $min_leave_hour;

    /**
     * 是否按照自然日统计请假时长，当为false的时候，用户发起请假时候会根据用户在请假时间段内的排班情况来计算请假时长。
     */
    public $natural_day_leave;

    /**
     * 是否带薪假期
     */
    public $paid_leave;

    /**
     * 限时提交规则
     */
    public $submit_time_rule;

    /**
     * 该假期类型的“适用范围”规则列表
     */
    public $visibility_rules;

    /**
     * 新员工请假：何时可以请假（entry-入职开始 、formal-转正后）
     */
    public $when_can_leave;
}
