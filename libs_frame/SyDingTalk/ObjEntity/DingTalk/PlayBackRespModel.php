<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 回放查询响应model
 *
 * @author auto create
 */
class PlayBackRespModel
{
    /**
     * 结果总数
     */
    public $all_count;

    /**
     * 是否还有
     */
    public $has_more;

    /**
     * 偏移量
     */
    public $offset;

    /**
     * 页面大小
     */
    public $page_size;

    /**
     * 分页查询结果
     */
    public $play_back_list;
}
