<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 调用结果
 *
 * @author auto create
 */
class PageInfo
{
    /**
     * 分页数组
     */
    public $list;

    /**
     * 当前页数
     */
    public $page;

    /**
     * 分页属性 - 分页大小
     */
    public $page_size;

    /**
     * 分页属性 - 总共数量
     */
    public $total;
}
