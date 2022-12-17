<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求
 *
 * @author auto create
 */
class SaveTaskRequest
{
    /**
     * 节点id
     */
    public $activity_id;

    /**
     * 应用id
     */
    public $agentid;

    /**
     * 实例id
     */
    public $process_instance_id;

    /**
     * 任务列表
     */
    public $tasks;
}
