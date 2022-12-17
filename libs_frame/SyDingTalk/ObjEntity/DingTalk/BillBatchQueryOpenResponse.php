<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * result
 *
 * @author auto create
 */
class BillBatchQueryOpenResponse
{
    /**
     * billList
     */
    public $bill_list;

    /**
     * 当前页码
     */
    public $current_page_num;

    /**
     * 如果nextKey不为空，说明还有翻页数据
     */
    public $next_key;

    /**
     * 每页大小
     */
    public $page_size;

    /**
     * 总记录条数
     */
    public $total_count;

    /**
     * 总页数
     */
    public $total_page;
}
