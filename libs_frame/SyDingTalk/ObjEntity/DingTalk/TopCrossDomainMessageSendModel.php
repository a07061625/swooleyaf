<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 互通消息结构
 *
 * @author auto create
 */
class TopCrossDomainMessageSendModel
{
    /**
     * 消息ID
     */
    public $message_id;

    /**
     * 接收者结构体
     */
    public $message_receiver_scope_model;

    /**
     * 会话免打扰，不填或填false为能接收通知；true为开启会话免打扰
     */
    public $new_conversation_notification_off;

    /**
     * 消息发送结构
     */
    public $send_message_model;

    /**
     * 发送者
     */
    public $sender;
}
