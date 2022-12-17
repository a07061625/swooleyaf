<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 创建日志的参数对象
 *
 * @author auto create
 */
class OapiCreateReportParam
{
    /**
     * 保存日志内容对应的模板某个字段的唯一序列id
     */
    public $contents;

    /**
     * 日志来源，每个组织可以自己起一个唯一的来源标识
     */
    public $dd_from;

    /**
     * 模板id
     */
    public $template_id;

    /**
     * 发送日志到员工时是否发送单聊消息
     */
    public $to_chat;

    /**
     * 日志发送到的群id
     */
    public $to_cids;

    /**
     * 日志发送到的员工id
     */
    public $to_userids;

    /**
     * 创建日志的员工id
     */
    public $userid;
}
