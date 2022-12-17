<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 分页数据
 *
 * @author auto create
 */
class HrmApiPage
{
    /**
     * 当前页
     */
    public $current;

    /**
     * 实际每条数据
     */
    public $data_list;

    /**
     * 每页最大数量，最大100
     */
    public $page_size;

    /**
     * 总数
     */
    public $total;

    /**
     * 总页数
     */
    public $total_page;
}
