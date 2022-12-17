<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 审批列表
 *
 * @author auto create
 */
class ApproverNode
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
     * 报销审批单状态：0审批中 1已同意 2已拒绝 3已转交，4已取消 5已终止
     */
    public $status;

    /**
     * 审批人id
     */
    public $userid;
}
