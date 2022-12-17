<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 消息体，具体见文档
 *
 * @author auto create
 */
class Msg
{
    /**
     * 卡片消息
     */
    public $action_card;

    /**
     * markdown消息
     */
    public $markdown;

    /**
     * 消息类型
     */
    public $msgtype;

    /**
     * 文本消息
     */
    public $text;
}
