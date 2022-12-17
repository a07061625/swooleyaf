<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 终止审批请求
 *
 * @author auto create
 */
class TerminateProcessInstanceRequestV2
{
    /**
     * 是否系统调用
     */
    public $is_system;

    /**
     * 操作人工号
     */
    public $operating_userid;

    /**
     * 审批实例
     */
    public $process_instance_id;

    /**
     * 说明
     */
    public $remark;
}
