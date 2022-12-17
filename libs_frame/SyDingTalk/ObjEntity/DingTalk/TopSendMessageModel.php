<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 消息发送结构
 *
 * @author auto create
 */
class TopSendMessageModel
{
    /**
     * 会话ID
     */
    public $cid;

    /**
     * 消息内容
     */
    public $content;

    /**
     * 消息内容类型1:文本 2:卡片
     */
    public $content_type;

    /**
     * 会话类型
     */
    public $conversation_type;

    /**
     * UUID
     */
    public $uuid;
}
