<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 假期消费记录列表
 *
 * @author auto create
 */
class OapiLeaveRecordVo
{
    /**
     * 计算类型(add delete update 如果是请假则为null)
     */
    public $cal_type;

    /**
     * 额度有效期结束时间(毫秒级时间戳)
     */
    public $end_time;

    /**
     * 假期类型唯一标识
     */
    public $leave_code;

    /**
     * 原因
     */
    public $leave_reason;

    /**
     * 假期记录类型(leave update其中一种 请假还是更新配额)
     */
    public $leave_record_type;

    /**
     * 请假状态(请假申请 init 请假通过 success 请假被拒 refuse 请假撤销 abort 撤销已同意的请假单并通过 revoke其中一种)
     */
    public $leave_status;

    /**
     * 显示单位(day hour 其中一种按天、小时计算)
     */
    public $leave_view_unit;

    /**
     * 假期记录标识(扣减多条假期配额 该值不为空)
     */
    public $parent_record_id;

    /**
     * 假期额度唯一标识
     */
    public $quota_id;

    /**
     * 假期消费记录唯一标识
     */
    public $record_id;

    /**
     * 单位以天计算的消费额度(假期类型按天计算该值不为空且按百分之一天折算 例如 100=1天)
     */
    public $record_num_per_day;

    /**
     * 单位以小时计算的消费额度(假期类型按小时计算该值不为空且按百分之一小时折算 例如 100=1小时)
     */
    public $record_num_per_hour;

    /**
     * 额度有效期开始时间(毫秒级时间戳)
     */
    public $start_time;

    /**
     * 员工ID
     */
    public $userid;
}
