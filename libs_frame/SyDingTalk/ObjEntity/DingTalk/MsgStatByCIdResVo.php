<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * list
 *
 * @author auto create
 */
class MsgStatByCIdResVo
{
    /**
     * 群Id
     */
    public $conversation_id;

    /**
     * 钉钉id
     */
    public $dingtalk_id;

    /**
     * 成员名称
     */
    public $name;

    /**
     * 机器人消息推送Id
     */
    public $push_id;

    /**
     * 是否已读
     */
    public $read_status;
}
