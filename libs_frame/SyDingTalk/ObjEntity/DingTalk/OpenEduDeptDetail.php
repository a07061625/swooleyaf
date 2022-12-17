<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 部门详情
 *
 * @author auto create
 */
class OpenEduDeptDetail
{
    /**
     * 部门链，不包括当前部门
     */
    public $chain;

    /**
     * 通讯录类型。自定义or经典模型
     */
    public $contact_type;

    /**
     * 部门id
     */
    public $dept_id;

    /**
     * 部门节点类型
     */
    public $dept_type;

    /**
     * 部门节点特有属性
     */
    public $feature;

    /**
     * 部门名
     */
    public $name;

    /**
     * 部门nick
     */
    public $nick;
}
