<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * result
 *
 * @author auto create
 */
class GetMessageStatusResponse
{
    /**
     * 消息任务执行返回码 0表示成功
     */
    public $task_code;

    /**
     * 错误信息
     */
    public $task_msg;

    /**
     * 消息任务执行状态 0：初始化，刚提交时的状态 3：处理中 4：处理完成 5：撤销
     */
    public $task_status;
}
