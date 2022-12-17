<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 用户属性
 *
 * @author auto create
 */
class GetProfileResp
{
    /**
     * 业务方的唯一id
     */
    public $app_userid;

    /**
     * 头像的mediaid
     */
    public $avatar_mediaid;

    /**
     * 业务方渠道ID
     */
    public $channel;

    /**
     * 附件信息
     */
    public $extension;

    /**
     * im的唯一id
     */
    public $im_openid;

    /**
     * 昵称
     */
    public $nick;

    /**
     * 用户状态 1 未激活 2 已激活 3 已注销
     */
    public $status;
}
