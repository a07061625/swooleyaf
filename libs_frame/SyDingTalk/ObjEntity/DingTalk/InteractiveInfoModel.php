<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 互动信息model
 *
 * @author auto create
 */
class InteractiveInfoModel
{
    /**
     * 消息数
     */
    public $message_count;

    /**
     * 点赞数
     */
    public $praise_count;

    /**
     * 观看总次数
     */
    public $pv;

    /**
     * 观看总人数（去重）
     */
    public $uv;
}
