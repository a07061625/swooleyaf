<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 修改profile入参
 *
 * @author auto create
 */
class ModProfileReq
{
    /**
     * 账号信息
     */
    public $account_info;

    /**
     * 头像
     */
    public $avatar_mediaid;

    /**
     * 附带信息
     */
    public $extension;

    /**
     * nick
     */
    public $nick;
}
