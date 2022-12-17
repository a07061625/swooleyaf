<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 管理组详情
 *
 * @author auto create
 */
class OpenRoleCreateVo
{
    /**
     * aciton列表
     */
    public $open_action;

    /**
     * 成员列表
     */
    public $open_members;

    /**
     * 资源列表
     */
    public $open_resources;

    /**
     * 管理组id,注意:创建的时候不要填写
     */
    public $open_role_id;

    /**
     * 管理组名
     */
    public $open_role_name;
}
