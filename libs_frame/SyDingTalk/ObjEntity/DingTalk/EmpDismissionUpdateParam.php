<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 离职信息
 *
 * @author auto create
 */
class EmpDismissionUpdateParam
{
    /**
     * 离职备注
     */
    public $dismission_memo;

    /**
     * 最后工作日期
     */
    public $last_work_date;

    /**
     * 是否计入离职不统计
     */
    public $partner;

    /**
     * 主动原因
     */
    public $termination_reason_passive;

    /**
     * 被动原因
     */
    public $termination_reason_voluntary;

    /**
     * 员工userId
     */
    public $userid;
}
