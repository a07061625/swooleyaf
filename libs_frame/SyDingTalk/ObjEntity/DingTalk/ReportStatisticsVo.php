<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 统计结果
 *
 * @author auto create
 */
class ReportStatisticsVo
{
    /**
     * 评论个数
     */
    public $comment_num;

    /**
     * 评论人数，去重
     */
    public $comment_user_num;

    /**
     * 点赞人数
     */
    public $like_num;

    /**
     * 已读人数
     */
    public $read_num;
}
