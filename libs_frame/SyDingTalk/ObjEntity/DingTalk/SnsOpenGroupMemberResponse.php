<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果数据
 *
 * @author auto create
 */
class SnsOpenGroupMemberResponse
{
    /**
     * 群成员是否还有下页数据
     */
    public $has_more;

    /**
     * 成员列表
     */
    public $members;

    /**
     * 下一页的游标
     */
    public $next_cursor;
}
