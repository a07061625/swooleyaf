<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 任务对外接口
 *
 * @author auto create
 */
class TaskSendVo
{
    /**
     * 任务内容
     */
    public $content;

    /**
     * 任务内容类型；1-文本；目前只支持文本；
     */
    public $content_type;

    /**
     * 任务截止时间（单位：毫秒），datetime转成long
     */
    public $dead_line;

    /**
     * 任务执行人
     */
    public $receiver_userid;

    /**
     * 提醒时间（单位：毫秒），datetime转成long
     */
    public $remind_time;

    /**
     * 提醒方式；1-应用内；目前只支持应用内；
     */
    public $remind_type;

    /**
     * 发送者ID
     */
    public $send_userid;
}
