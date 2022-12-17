<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 参数结构体
 *
 * @author auto create
 */
class UpdateEntranceIdRequest
{
    /**
     * 要设置的用户列表
     */
    public $accounts;

    /**
     * 业务channel
     */
    public $channel;

    /**
     * 会话id
     */
    public $cid;

    /**
     * 入口id，数字
     */
    public $entrance_id;

    /**
     * 扩展信息，可选
     */
    public $extension;

    /**
     * 该请求的唯一id，用于去重、打日志
     */
    public $uuid;
}
