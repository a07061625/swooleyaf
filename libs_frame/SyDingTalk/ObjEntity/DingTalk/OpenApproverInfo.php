<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 审批人列表
 *
 * @author auto create
 */
class OpenApproverInfo
{
    /**
     * 审批意见
     */
    public $note;

    /**
     * 操作时间
     */
    public $operate_time;

    /**
     * 审批人顺序
     */
    public $order;

    /**
     * 审批状态：0审批中 1已同意 2已拒绝 3已转交，4已取消 5已终止 6发起审批 7评论
     */
    public $status;

    /**
     * 审批状态描述
     */
    public $status_desc;

    /**
     * 审批人名称
     */
    public $user_name;

    /**
     * 审批人id
     */
    public $userid;
}
