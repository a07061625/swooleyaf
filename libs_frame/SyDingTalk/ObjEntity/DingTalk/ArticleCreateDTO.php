<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 文章对象
 *
 * @author auto create
 */
class ArticleCreateDTO
{
    /**
     * 文章id
     */
    public $article_id;

    /**
     * html码
     */
    public $content;

    /**
     * 摘要
     */
    public $digest;

    /**
     * 封面图
     */
    public $thumb_media_id;

    /**
     * 标题
     */
    public $title;
}
