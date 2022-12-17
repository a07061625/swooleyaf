<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * operationRecords
 *
 * @author auto create
 */
class OperationRecordsVo
{
    /**
     * 时间
     */
    public $date;

    /**
     * 操作结果，分为AGREE（同意），REFUSE（拒绝）
     */
    public $operation_result;

    /**
     * 操作类型，分为EXECUTE_TASK_NORMAL（正常执行任务），EXECUTE_TASK_AGENT（代理人执行任务），APPEND_TASK_BEFORE（前加签任务），APPEND_TASK_AFTER（后加签任务），REDIRECT_TASK（转交任务），START_PROCESS_INSTANCE（发起流程实例），TERMINATE_PROCESS_INSTANCE（终止(撤销)流程实例），FINISH_PROCESS_INSTANCE（结束流程实例），ADD_REMARK（添加评论）
     */
    public $operation_type;

    /**
     * 评论
     */
    public $remark;

    /**
     * 操作人
     */
    public $userid;
}
