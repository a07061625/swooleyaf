<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 使用独立跳转ActionCard样式时的按钮列表；必须与btn_orientation同时设置
 *
 * @author auto create
 */
class Button
{
    /**
     * 消息点击链接地址，当发送消息为小程序时支持小程序跳转链接，最长500个字符
     */
    public $action_url;

    /**
     * 使用独立跳转ActionCard样式时的按钮的标题，最长20个字符
     */
    public $title;
}
