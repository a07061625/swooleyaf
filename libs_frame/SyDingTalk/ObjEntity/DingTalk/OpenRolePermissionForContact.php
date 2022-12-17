<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 权限设置列表
 *
 * @author auto create
 */
class OpenRolePermissionForContact
{
    /**
     * 部门id列表
     */
    public $dept_ids;

    /**
     * 角色id列表
     */
    public $role_ids;

    /**
     * SubjectSide(1) 还是 ObjectSide(2)
     */
    public $side;

    /**
     * permit(1) 还是 deny(2)
     */
    public $type;

    /**
     * staffid列表
     */
    public $user_ids;

    /**
     * 可见性设置类型：5. permit_self_node_and_children(仅可见自己所在节点及子节点)    6. permit_self_node_only(仅可见自己所在的节点)    7. permit_self_only(仅可见自己)
     */
    public $visibility_type;
}
