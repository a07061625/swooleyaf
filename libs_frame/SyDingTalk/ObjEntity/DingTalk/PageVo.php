<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回的Page对象
 *
 * @author auto create
 */
class PageVo
{
    /**
     * 设备列表
     */
    public $list;

    /**
     * 下次拉取列表的游标，如果为Null，代表没有数据了
     */
    public $next_cursor;
}
