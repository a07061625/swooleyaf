<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 部门详情
 *
 * @author auto create
 */
class DeptGetResponse
{
    /**
     * 当群已经创建后，是否有新人加入部门会自动加入该群
     */
    public $auto_add_user;

    /**
     * 开启后，加入该部门的申请将默认同意
     */
    public $auto_approve_apply;

    /**
     * 部门简介
     */
    public $brief;

    /**
     * 是否同步创建一个关联此部门的企业群, true表示是, false表示不是
     */
    public $create_dept_group;

    /**
     * 部门群ID
     */
    public $dept_group_chat_id;

    /**
     * 部门ID
     */
    public $dept_id;

    /**
     * 部门的主管列表
     */
    public $dept_manager_userid_list;

    /**
     * 可以查看指定隐藏部门的其他人员列表，如果部门隐藏，则此值生效，取值为其他的人员userid组成的数组
     */
    public $dept_permits;

    /**
     * 扩展字段
     */
    public $extention;

    /**
     * 部门是否来自关联组织
     */
    public $from_union_org;

    /**
     * 部门群是否包含子部门
     */
    public $group_contain_sub_dept;

    /**
     * 是否隐藏部门, true表示隐藏, false表示显示
     */
    public $hide_dept;

    /**
     * 部门名称
     */
    public $name;

    /**
     * 在父部门中的次序值
     */
    public $order;

    /**
     * 企业群群主ID
     */
    public $org_dept_owner;

    /**
     * 是否本部门的员工仅可见员工自己, 为true时，本部门员工默认只能看到员工自己
     */
    public $outer_dept;

    /**
     * 本部门的员工仅可见员工自己为true时，可以配置额外可见部门
     */
    public $outer_permit_depts;

    /**
     * 本部门的员工仅可见员工自己为true时，可以配置额外可见人员
     */
    public $outer_permit_users;

    /**
     * 父部门id，根部门为1
     */
    public $parent_id;

    /**
     * 部门标识字段，开发者可用该字段来唯一标识一个部门，并与钉钉外部通讯录里的部门做映射
     */
    public $source_identifier;

    /**
     * 教育行业部门类型，包括campus,period,grade,class.
     */
    public $tags;

    /**
     * 联系方式（手机号码或座机号码）
     */
    public $telephone;

    /**
     * 可以查看指定隐藏部门的其他人员列表，如果部门隐藏，则此值生效，取值为其他的人员userid组成的数组
     */
    public $user_permits;
}
