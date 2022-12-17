<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求对象
 *
 * @author auto create
 */
class InviteDataQuery
{
    /**
     * 数据游标，初始传0。后续传入返回参数中的next_cursor值
     */
    public $cursor;

    /**
     * 每次查询数据量，最大100
     */
    public $size;

    /**
     * 状态0:无效（包括过程数据），1:有效(默认)，不传表示查询全部
     */
    public $status;
}
