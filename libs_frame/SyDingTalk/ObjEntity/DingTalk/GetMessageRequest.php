<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求信息
 *
 * @author auto create
 */
class GetMessageRequest
{
    /**
     * 从什么时候开始查，utc时间，单位毫秒
     */
    public $beg_time;

    /**
     * 群id
     */
    public $group_id;

    /**
     * 获取的消息数量，总的数量小于需要获取的数量时，返回实际的消息数量.1-20之间
     */
    public $limit_num;

    /**
     * 单聊消息时使用，暂时不支持，可以不填
     */
    public $receiver_id;

    /**
     * 单聊消息时使用，暂时不支持，可以不填
     */
    public $sender_id;
}
