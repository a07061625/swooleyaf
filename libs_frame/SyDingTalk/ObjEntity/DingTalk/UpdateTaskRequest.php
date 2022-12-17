<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * request
 *
 * @author auto create
 */
class UpdateTaskRequest
{
    /**
     * 任务组id
     */
    public $activity_id;

    /**
     * 任务组id列表
     */
    public $activity_id_list;

    /**
     * 应用id
     */
    public $agentid;

    /**
     * 实例id
     */
    public $process_instance_id;
}
