<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * result
 *
 * @author auto create
 */
class GroupMessageTaskQueryTopResponse
{
    /**
     * 是否还有更多页数
     */
    public $has_more;

    /**
     * 请求下一页的游标
     */
    public $next_cursor;

    /**
     * 已读员工的userids
     */
    public $read_staff_ids;

    /**
     * 发送结果码，只有SUCCESS为成功
     */
    public $send_status;
}
