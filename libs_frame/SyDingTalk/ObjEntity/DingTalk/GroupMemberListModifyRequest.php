<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 修改群成员列表入参
 *
 * @author auto create
 */
class GroupMemberListModifyRequest
{
    /**
     * 接入方channel信息，该值由接入方接入IMPaaS平台时，向IMPaaS平台申请，例如“hema”“eleme”等。
     */
    public $channel;

    /**
     * 群ID，由创建群接口返回。
     */
    public $chatid;

    /**
     * 待操作成员列表
     */
    public $member_list;

    /**
     * 该参数表示本次请求的操作类型，“1”表示添加成员，“2”表示删除成员。
     */
    public $modify_type;
}
