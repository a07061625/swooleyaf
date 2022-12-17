<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 系统账号发送消息参数
 *
 * @author auto create
 */
class SystemAccountSendMessageParam
{
    /**
     * 系统账号标识
     */
    public $account_key;

    /**
     * 消息模版标识
     */
    public $message_key;

    /**
     * 消息接收者userId列表
     */
    public $receiver_user_id_list;

    /**
     * 消息模版填充值
     */
    public $value_map;
}
