<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * request
 *
 * @author auto create
 */
class TopSendConversationMsgRequest
{
    /**
     * 占位符替换词
     */
    public $attributes;

    /**
     * 班级id
     */
    public $class_id;

    /**
     * 随机数，在小程序打开的时候传入。需要透传过来
     */
    public $nonce;

    /**
     * 接收者userid
     */
    public $receiver_user_ids;

    /**
     * 模板id
     */
    public $template_id;
}
