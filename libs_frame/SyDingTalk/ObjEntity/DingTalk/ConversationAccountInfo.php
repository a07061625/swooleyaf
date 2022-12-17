<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 接收者
 *
 * @author auto create
 */
class ConversationAccountInfo
{
    /**
     * 创建者账号ID，类型由type字段决定
     */
    public $id;

    /**
     * 账号ID类型，当type=staff时，id填写staffid，当type=channelUser时，id字段填写channelUserId
     */
    public $type;
}
