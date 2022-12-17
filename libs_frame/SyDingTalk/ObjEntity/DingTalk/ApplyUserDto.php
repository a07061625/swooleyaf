<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 帐号列表
 *
 * @author auto create
 */
class ApplyUserDto
{
    /**
     * 业务渠道
     */
    public $channel;

    /**
     * 扩展字段
     */
    public $extension;

    /**
     * 主帐号ID
     */
    public $outer_id;

    /**
     * 主帐号名称
     */
    public $outer_nick;

    /**
     * 子帐号ID
     */
    public $outer_sub_id;

    /**
     * 子帐号名称
     */
    public $outer_sub_nick;
}
