<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * pageResult
 *
 * @author auto create
 */
class PageResult
{
    /**
     * 是否还有更多数据
     */
    public $has_more;

    /**
     * 下次翻页的入参
     */
    public $offset;

    /**
     * 能获取的总条数(offset+size不能超过这个值)
     */
    public $total;

    /**
     * value
     */
    public $value_list;
}
