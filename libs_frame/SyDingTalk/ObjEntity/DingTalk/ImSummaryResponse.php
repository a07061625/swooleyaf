<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果对象
 *
 * @author auto create
 */
class ImSummaryResponse
{
    /**
     * 活跃群数（当日）
     */
    public $active_group_count;

    /**
     * 单聊用户数
     */
    public $chat_user_count;

    /**
     * 群聊用户数
     */
    public $group_chat_user_count;

    /**
     * 总群数
     */
    public $group_count;

    /**
     * 群聊消息数
     */
    public $group_message_count;

    /**
     * 发送群文件数（当日）
     */
    public $group_send_file_message_count;

    /**
     * 人均发送消息数
     */
    public $message_avg_count;

    /**
     * 消息数
     */
    public $message_total_count;

    /**
     * 聊天用户数
     */
    public $message_user_count;

    /**
     * 新增群数（当日）
     */
    public $new_group_count;

    /**
     * 单聊消息数
     */
    public $single_message_count;
}
