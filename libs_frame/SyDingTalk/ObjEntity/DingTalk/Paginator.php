<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 分页结果
 *
 * @author auto create
 */
class Paginator
{
    /**
     * 数据结果列表
     */
    public $data_list;

    /**
     * 下一次分页调用的offset值，当返回结果里没有nextCursor时，表示分页结束
     */
    public $next_cursor;
}
