<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 修改后的群主，若为空或与当前群主相同，则不会对群主进行变更操作。
 *
 * @author auto create
 */
class BaseGroupMemberInfo
{
    /**
     * 修改后的群主ID，ID类型由type字段决定
     */
    public $id;

    /**
     * ID类型，当type=staff时，id填写staffid，当type=channelUser时，id字段填写channelUserId
     */
    public $type;
}
