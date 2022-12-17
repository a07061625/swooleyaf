<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 消息体
 *
 * @author auto create
 */
class Body
{
    /**
     * 自定义的作者名字
     */
    public $author;

    /**
     * 消息体的内容，最多显示3行
     */
    public $content;

    /**
     * 自定义的附件数目。此数字仅供显示，钉钉不作验证
     */
    public $file_count;

    /**
     * 消息体的表单，最多显示6个，超过会被隐藏
     */
    public $form;

    /**
     * 消息体中的图片，支持图片资源@mediaId
     */
    public $image;

    /**
     * 单行富文本信息
     */
    public $rich;

    /**
     * 消息体的标题，建议50个字符以内
     */
    public $title;
}
