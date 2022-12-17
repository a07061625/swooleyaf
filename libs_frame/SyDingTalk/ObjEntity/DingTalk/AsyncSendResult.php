<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * result
 *
 * @author auto create
 */
class AsyncSendResult
{
    /**
     * 发送失败的用户id
     */
    public $failed_user_id_list;

    /**
     * 因发送消息过于频繁或超量而被流控过滤后实际未发送的userid。未被限流的接收者仍会被成功发送。限流规则包括：1、给同一用户发相同内容消息一天仅允许一次；2、如果是ISV接入方式，给同一用户发消息一天不得超过100次；如果是企业接入方式，此上限为500。
     */
    public $forbidden_user_id_list;

    /**
     * 无效的部门id
     */
    public $invalid_dept_id_list;

    /**
     * 无效的用户id
     */
    public $invalid_user_id_list;

    /**
     * 已读消息的用户id
     */
    public $read_user_id_list;

    /**
     * 未读消息的用户id
     */
    public $unread_user_id_list;
}
