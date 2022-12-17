<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 分页结果
 *
 * @author auto create
 */
class DdAtsPageResult
{
    /**
     * 是否还有数据
     */
    public $has_more;

    /**
     * 职位信息列表
     */
    public $list;

    /**
     * 游标，下次分页请求使用
     */
    public $next_cursor;
}
