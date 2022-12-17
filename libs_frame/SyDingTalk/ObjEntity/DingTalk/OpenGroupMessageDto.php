<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 消息
 *
 * @author auto create
 */
class OpenGroupMessageDto
{
    /**
     * 消息的at人信息
     */
    public $at_users;

    /**
     * 消息发送时间
     */
    public $create_at;

    /**
     * 消息内容密文
     */
    public $msg_content;
}
