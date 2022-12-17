<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果数据
 *
 * @author auto create
 */
class OpenPageResult
{
    /**
     * 知识库列表
     */
    public $data;

    /**
     * 是否还有更多的数据
     */
    public $has_more;

    /**
     * 下一次分页的游标
     */
    public $next_cursor;
}
