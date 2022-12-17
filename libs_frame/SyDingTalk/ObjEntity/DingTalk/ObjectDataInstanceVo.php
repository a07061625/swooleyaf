<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 联系人数据
 *
 * @author auto create
 */
class ObjectDataInstanceVo
{
    /**
     * 记录创建人的昵称
     */
    public $creator_nick;

    /**
     * 记录创建人的用户ID
     */
    public $creator_userid;

    /**
     * 数据内容
     */
    public $data;

    /**
     * 扩展数据内容
     */
    public $extend_data;

    /**
     * 权限
     */
    public $permission;
}
