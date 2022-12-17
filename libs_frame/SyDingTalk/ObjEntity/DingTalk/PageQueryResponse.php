<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 数据结果
 *
 * @author auto create
 */
class PageQueryResponse
{
    /**
     * 是否还有更多数据
     */
    public $has_more;

    /**
     * 学科元数据列表
     */
    public $list;

    /**
     * 下一页游标
     */
    public $next_cursor;

    /**
     * 总数据条数
     */
    public $total_count;
}
