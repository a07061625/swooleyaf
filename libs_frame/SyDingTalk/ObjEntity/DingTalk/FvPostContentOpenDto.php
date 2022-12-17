<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 动态的内容
 *
 * @author auto create
 */
class FvPostContentOpenDto
{
    /**
     * 附件内容
     */
    public $attachments;

    /**
     * 动态类型，1：文本动态；2：图片动态；3：视频动态
     */
    public $content_type;

    /**
     * 图片内容
     */
    public $photo_content;

    /**
     * 文本内容
     */
    public $text;

    /**
     * 视频内容
     */
    public $video_content;
}
