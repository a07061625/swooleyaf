<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 消息的at人信息
 *
 * @author auto create
 */
class OpenGroupMessageAtUserDto
{
    /**
     * unionId（如果没有userId则提供unionId)
     */
    public $unionid;

    /**
     * userId
     */
    public $userid;
}
