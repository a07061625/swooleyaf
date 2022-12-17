<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 根据异步发送时返回的taskid获取消息
 *
 * @author auto create
 */
class GetMessageStatusRequest
{
    /**
     * 账号信息
     */
    public $senderid;

    /**
     * 异步返回的任务ID
     */
    public $taskid;
}
