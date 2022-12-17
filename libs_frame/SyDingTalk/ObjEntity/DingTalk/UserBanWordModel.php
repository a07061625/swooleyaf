<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 单个人禁言的状态
 *
 * @author auto create
 */
class UserBanWordModel
{
    /**
     * true为该用户禁言，false该用户没有被禁言
     */
    public $ban_words_status;

    /**
     * 结束禁言的时间戳
     */
    public $end_time;

    /**
     * 开始禁言的时间戳
     */
    public $start_time;
}
