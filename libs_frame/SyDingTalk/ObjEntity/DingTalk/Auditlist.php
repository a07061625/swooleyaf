<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 审批人列表
 *
 * @author auto create
 */
class Auditlist
{
    /**
     * 备注
     */
    public $note;

    /**
     * 审批操作时间
     */
    public $operate_time;

    /**
     * 审批状态：0审批中 1已同意 2已拒绝 3已转交，4已取消 5已终止
     */
    public $status;

    /**
     * 审批人id
     */
    public $userid;
}
