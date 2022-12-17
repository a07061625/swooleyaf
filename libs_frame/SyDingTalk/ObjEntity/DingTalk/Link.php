<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 链接消息
 *
 * @author auto create
 */
class Link
{
    /**
     * 消息点击链接地址，当发送消息为小程序时支持小程序跳转链接
     */
    public $message_url;

    /**
     * 图片地址
     */
    public $pic_url;

    /**
     * 消息描述，建议500字符以内
     */
    public $text;

    /**
     * 消息标题，建议100字符以内
     */
    public $title;
}
