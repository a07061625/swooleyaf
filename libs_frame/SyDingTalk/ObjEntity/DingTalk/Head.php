<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 消息头部内容
 *
 * @author auto create
 */
class Head
{
    /**
     * 消息头部的背景颜色。长度限制为8个英文字符，其中前2为表示透明度，后6位表示颜色值。不要添加0x
     */
    public $bgcolor;

    /**
     * 消息的头部标题 (向普通会话发送时有效，向企业会话发送时会被替换为微应用的名字)，长度限制为最多10个字符
     */
    public $text;
}
