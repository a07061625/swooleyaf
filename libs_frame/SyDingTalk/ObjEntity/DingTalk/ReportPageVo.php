<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 统计结果
 *
 * @author auto create
 */
class ReportPageVo
{
    /**
     * 是否还有下一页
     */
    public $has_more;

    /**
     * 下一次分页调用的offset值，当返回结果里没有next_cursor时，表示分页结束
     */
    public $next_cursor;

    /**
     * userid列表
     */
    public $userid_list;
}
