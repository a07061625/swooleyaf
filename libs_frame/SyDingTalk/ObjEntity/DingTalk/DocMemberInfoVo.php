<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 文档授权成员列表，仅授权文档操作有效
 *
 * @author auto create
 */
class DocMemberInfoVo
{
    /**
     * 成员名称
     */
    public $member_name;

    /**
     * 成员类型
     */
    public $member_type;

    /**
     * 成员类型翻译值
     */
    public $member_type_view;

    /**
     * 权限角色
     */
    public $permission_role;

    /**
     * 权限角色预览
     */
    public $permission_role_view;
}
