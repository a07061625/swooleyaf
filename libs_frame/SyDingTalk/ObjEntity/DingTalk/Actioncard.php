<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 此消息类型为固定actionCard
 *
 * @author auto create
 */
class Actioncard
{
    /**
     * 0-按钮竖直排列，1-按钮横向排列
     */
    public $btn_orientation;
    /**
     * 按钮的信息
     */
    public $btns;
    /**
     * 0-正常发消息者头像,1-隐藏发消息者头像
     */
    public $hide_avatar;
    /**
     * 单个按钮的方案。(设置此项和singleURL后btns无效。)
     */
    public $single_title;
    /**
     * 点击singleTitle按钮触发的URL
     */
    public $single_u_r_l;
    /**
     * markdown格式的消息
     */
    public $text;
    /**
     * 首屏会话透出的展示内容
     */
    public $title;
}
