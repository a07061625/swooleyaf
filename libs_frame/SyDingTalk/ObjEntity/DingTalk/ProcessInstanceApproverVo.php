<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 审批人列表，支持会签/或签，优先级高于approvers变量
 *
 * @author auto create
 */
class ProcessInstanceApproverVo
{
    /**
     * 审批类型，会签：AND；或签：OR；单人：NONE
     */
    public $task_action_type;

    /**
     * 审批人userid列表，会签/或签列表长度必须大于1，非会签/或签列表长度只能为1
     */
    public $user_ids;
}
