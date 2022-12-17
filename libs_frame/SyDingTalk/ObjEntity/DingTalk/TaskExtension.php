<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 任务的扩展字段
 *
 * @author auto create
 */
class TaskExtension
{
    /**
     * 评论数量
     */
    public $comment_count;

    /**
     * 附件地址
     */
    public $file_path;

    /**
     * 用户可扩展的字段
     */
    public $other;

    /**
     * 待办系统属性，主要包含接入方的详情页跳转链接
     */
    public $system_property;
}
