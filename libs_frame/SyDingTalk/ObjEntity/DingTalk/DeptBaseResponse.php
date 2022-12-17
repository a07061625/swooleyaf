<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 部门列表
 *
 * @author auto create
 */
class DeptBaseResponse
{
    /**
     * 当群已经创建后，是否有新人加入部门会自动加入该群
     */
    public $auto_add_user;

    /**
     * 是否同步创建一个关联此部门的企业群
     */
    public $create_dept_group;

    /**
     * 部门ID
     */
    public $dept_id;

    /**
     * 扩展字段
     */
    public $ext;

    /**
     * 部门是否来自关联组织
     */
    public $from_union_org;

    /**
     * 部门名称
     */
    public $name;

    /**
     * 父部门ID
     */
    public $parent_id;

    /**
     * 部门标识字段
     */
    public $source_identifier;

    /**
     * 教育行业部门类型
     */
    public $tags;
}
