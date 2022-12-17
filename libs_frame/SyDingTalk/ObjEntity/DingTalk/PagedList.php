<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 符合条件的当前页数据
 *
 * @author auto create
 */
class PagedList
{
    /**
     * 游标，下一次请求需要传入的下一次请求时需传入的游标值
     */
    public $cursor;

    /**
     * 是否还有下一页数据
     */
    public $has_more;

    /**
     * 符合条件的设备
     */
    public $items;
}
