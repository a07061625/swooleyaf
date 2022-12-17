<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 待初始化的假期余额记录
 *
 * @author auto create
 */
class LeaveQuotas
{
    /**
     * 额度有效期结束时间(毫秒级时间戳)
     */
    public $end_time;

    /**
     * 假期类型唯一标识
     */
    public $leave_code;

    /**
     * 额度所对应的周期(除了假期类型为调休的时候可以为空之外 其他情况均不能为空 且格式必须满足"yyyy")
     */
    public $quota_cycle;

    /**
     * 单位以天计算的额度总数(假期类型按天计算该值不为空且按百分之一天折算 例如 100=1天)
     */
    public $quota_num_per_day;

    /**
     * 单位以小时计算的额度总数(假期类型按小时计算该值不为空且按百分之一小时折算 例如 100=1小时)
     */
    public $quota_num_per_hour;

    /**
     * 操作原因
     */
    public $reason;

    /**
     * 额度有效期开始时间(毫秒级时间戳)
     */
    public $start_time;

    /**
     * 员工ID
     */
    public $userid;
}
