<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 发DING的请求体
 *
 * @author auto create
 */
class OpenDingSendVo
{
    /**
     * 附件
     */
    public $attachment;

    /**
     * 接收者工号列表
     */
    public $receiver_uids;

    /**
     * 提醒类型:1-应用内;2-短信
     */
    public $remind_type;

    /**
     * 通知内容
     */
    public $text_content;
}
