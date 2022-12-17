<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 文章列表
 *
 * @author auto create
 */
class ArticleDTO
{
    /**
     * 文章id
     */
    public $article_id;

    /**
     * 文章内容
     */
    public $content;

    /**
     * 创建时间
     */
    public $create_time;

    /**
     * 摘要
     */
    public $digest;

    /**
     * 发布状态，0-未发布，1-已发布
     */
    public $publish_status;

    /**
     * 发布时间
     */
    public $publish_time;

    /**
     * 封面图片的素材id
     */
    public $thumb_media_id;

    /**
     * 标题
     */
    public $title;

    /**
     * 阅读次数
     */
    public $total_view_count;

    /**
     * 修改时间
     */
    public $update_time;

    /**
     * 文章链接
     */
    public $url;

    /**
     * 已读用户数
     */
    public $user_view_count;
}
