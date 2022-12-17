<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果对象
 *
 * @author auto create
 */
class DauSummaryResponse
{
    /**
     * 激活人数（累计）
     */
    public $activated_count;

    /**
     * 钉钉app的登录用户
     */
    public $app_active_users;

    /**
     * 聊天用户数
     */
    public $chat_user_count;

    /**
     * 通讯录人数
     */
    public $contacts_count;

    /**
     * 日活跃人数
     */
    public $daily_active_users;

    /**
     * 钉钉pc端的登录用户
     */
    public $pc_active_users;
}
