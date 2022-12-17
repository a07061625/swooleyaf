<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 部门节点列表，不空。
 *
 * @author auto create
 */
class OpenEduDeptDetails
{
    /**
     * 部门链
     */
    public $chain;

    /**
     * 家校通讯录类型。自定义or标准
     */
    public $contact_type;

    /**
     * 节点id
     */
    public $dept_id;

    /**
     * 节点类型
     */
    public $dept_type;

    /**
     * 节点特有属性
     */
    public $feature;

    /**
     * 节点名
     */
    public $name;

    /**
     * 可空
     */
    public $nick;
}
