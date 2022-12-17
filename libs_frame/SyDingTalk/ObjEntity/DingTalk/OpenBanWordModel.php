<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果集
 *
 * @author auto create
 */
class OpenBanWordModel
{
    /**
     * true为开启全员禁言，false为关闭全员禁言
     */
    public $all_ban_words;

    /**
     * 单个人禁言的状态
     */
    public $user_ban_words;
}
