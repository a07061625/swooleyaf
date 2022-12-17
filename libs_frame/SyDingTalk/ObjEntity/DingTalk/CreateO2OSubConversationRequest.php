<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求
 *
 * @author auto create
 */
class CreateO2OSubConversationRequest
{
    /**
     * 账号列表，size=2。第一个表示自己，第二个表示对方
     */
    public $account_info_list;

    /**
     * channel名称
     */
    public $channel;

    /**
     * 入口id列表，size=2。普通会话填0，二级会话填entrnaceid
     */
    public $entrance_id_list;

    /**
     * 扩展信息
     */
    public $extension;

    /**
     * 用于去重和追踪
     */
    public $uuid;
}
