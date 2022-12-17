<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 分页查询结果
 *
 * @author auto create
 */
class PageQueryCursorResult
{
    /**
     * 动作列表
     */
    public $action_list;

    /**
     * 还有数据
     */
    public $has_more;

    /**
     * 下一页的游标
     */
    public $next_cursor;

    /**
     * 总数
     */
    public $total;
}
