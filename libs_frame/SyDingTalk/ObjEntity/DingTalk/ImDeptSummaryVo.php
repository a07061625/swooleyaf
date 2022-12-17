<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * data
 *
 * @author auto create
 */
class ImDeptSummaryVo
{
    /**
     * 部门id
     */
    public $dept_id;

    /**
     * 部门名称
     */
    public $dept_name;

    /**
     * 最近天一天群聊消息数
     */
    public $group_message_cnt;

    /**
     * 最近1天发送群文件数
     */
    public $group_send_file_message_cnt;

    /**
     * 最近1天发消息数
     */
    public $message_cnt;

    /**
     * 最近一天群聊消息人数
     */
    public $send_group_message_user_cnt;

    /**
     * 最近一天人均发送消息数
     */
    public $send_message_avg_cnt;

    /**
     * 最近一天发消息人数
     */
    public $send_message_user_cnt;

    /**
     * 最近一天单聊消息人数
     */
    public $send_single_message_user_cnt;

    /**
     * 最近一天单聊消息数
     */
    public $single_message_cnt;
}
