<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 实例列表
 *
 * @author auto create
 */
class UpdateProcessInstanceRequest
{
    /**
     * 实例id，通过创建待办实例接口获取
     */
    public $process_instance_id;

    /**
     * 任务结果，分为agree和refuse
     */
    public $result;

    /**
     * 实例状态，分为COMPLETED, TERMINATED
     */
    public $status;
}
