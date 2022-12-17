<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求
 *
 * @author auto create
 */
class AddCommentRequest
{
    /**
     * 评论人工号
     */
    public $comment_userid;

    /**
     * 文件类
     */
    public $file;

    /**
     * 实例id
     */
    public $process_instance_id;

    /**
     * 评论内容
     */
    public $text;
}
