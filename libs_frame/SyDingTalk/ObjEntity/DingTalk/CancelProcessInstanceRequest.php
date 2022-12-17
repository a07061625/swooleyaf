<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 入参
 *
 * @author auto create
 */
class CancelProcessInstanceRequest
{
    /**
     * 本次作废操作的发起者名字，通常指代系统名称
     */
    public $operator_name;

    /**
     * 审批实例id
     */
    public $process_instance_id;

    /**
     * 本次作废操作的系统描述，会在审批操作记录里已操作备注的形式展示出来
     */
    public $remark;
}
