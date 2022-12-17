<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求
 *
 * @author auto create
 */
class ExecuteTaskRequest
{
    /**
     * 操作人id，通过dingtalk.smartwork.bpms.processinstance.get这个接口可以获取
     */
    public $actioner_userid;

    /**
     * 文件
     */
    public $file;

    /**
     * 审批实例id
     */
    public $process_instance_id;

    /**
     * 操作评论，可为空
     */
    public $remark;

    /**
     * 审批操作，同意-agree，拒绝-refuse
     */
    public $result;

    /**
     * 任务节点id，dingtalk.smartwork.bpms.processinstance.get接口可获取
     */
    public $task_id;
}
