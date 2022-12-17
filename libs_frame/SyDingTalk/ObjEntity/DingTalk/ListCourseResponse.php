<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * result
 *
 * @author auto create
 */
class ListCourseResponse
{
    /**
     * 是否还有更多数据
     */
    public $has_more;

    /**
     * list
     */
    public $list;

    /**
     * 表示下一次分页的游标，如果next_corsor为null或者has_more为false，表示没有更多的分页数据
     */
    public $next_cursor;

    /**
     * 数量总计100
     */
    public $total_count;
}
