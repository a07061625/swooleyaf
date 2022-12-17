<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * oa消息
 *
 * @author auto create
 */
class OA
{
    /**
     * 消息体
     */
    public $body;

    /**
     * 消息头部内容
     */
    public $head;

    /**
     * 消息点击链接地址，当发送消息为小程序时支持小程序跳转链接
     */
    public $message_url;

    /**
     * PC端点击消息时跳转到的地址
     */
    public $pc_message_url;
}
