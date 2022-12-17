<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果对象
 *
 * @author auto create
 */
class MicroAppSummaryResponse
{
    /**
     * 数据列表
     */
    public $data;

    /**
     * 是否有下一页；true则存在更多分页
     */
    public $has_more;

    /**
     * 下一次请求的分页游标
     */
    public $next_cursor;
}
