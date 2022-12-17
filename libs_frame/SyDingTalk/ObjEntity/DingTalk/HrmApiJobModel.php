<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 员工信息对象，被操作人userid是必填，其他信息选填，填写则更新
 *
 * @author auto create
 */
class HrmApiJobModel
{
    /**
     * 生日日期
     */
    public $birth_time;

    /**
     * 入职日期
     */
    public $confirm_join_time;

    /**
     * 员工状态（2:试用，3:正式）
     */
    public $employee_status;

    /**
     * 员工类型（1:全职，2:兼职，3:实习，4:劳务派遣，5:退休返聘，6:劳务外包）
     */
    public $employee_type;

    /**
     * 首次参加工作时间
     */
    public $join_working_time;

    /**
     * 试用期（1:无试用期，2:1个月，3:2个月，4:3个月，5:4个月，6:5个月，7:6个月，8:其他）
     */
    public $probation_period_type;

    /**
     * 转正时间
     */
    public $regular_time;

    /**
     * 被操作人userid
     */
    public $userid;
}
