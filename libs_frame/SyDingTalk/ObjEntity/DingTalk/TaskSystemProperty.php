<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 待办系统属性，主要包含接入方的详情页跳转链接
 *
 * @author auto create
 */
class TaskSystemProperty
{
    /**
     * APP 跳转连接
     */
    public $app_url;

    /**
     * 来自钉钉群 id
     */
    public $group_id;

    /**
     * web 跳转连接
     */
    public $web_url;
}
