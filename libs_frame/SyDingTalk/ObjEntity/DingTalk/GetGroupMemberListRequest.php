<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求结构体
 *
 * @author auto create
 */
class GetGroupMemberListRequest
{
    /**
     * 群ID
     */
    public $chatid;

    /**
     * 本次请求返回的群成员列表数量
     */
    public $length;

    /**
     * 群成员列表偏移
     */
    public $offset;
}
