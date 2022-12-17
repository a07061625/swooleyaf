<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 消息体
 *
 * @author auto create
 */
class MessageBody
{
    /**
     * action_card卡片消息
     */
    public $action_card;

    /**
     * 文件消息
     */
    public $file;

    /**
     * 链接消息
     */
    public $link;

    /**
     * markdown消息
     */
    public $markdown;

    /**
     * oa消息
     */
    public $oa;

    /**
     * 语音消息
     */
    public $voice;
}
