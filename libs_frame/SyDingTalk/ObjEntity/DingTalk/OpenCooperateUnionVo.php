<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 加入/申请加入空间信息
 *
 * @author auto create
 */
class OpenCooperateUnionVo
{
    /**
     * 加入企业认证等级0 未认证 1高级认证 2中级认证 3初级认证
     */
    public $auth_level;

    /**
     * 挂载部门ID(在合作空间中的架构属性)
     */
    public $dept_id;

    /**
     * 加入的部门列表(部门下的员工会全部加入)
     */
    public $dept_ids;

    /**
     * 挂载部门名称(在合作空间中的架构属性)，不设置默认是加入企业的名称
     */
    public $dept_name;

    /**
     * 加入企业的企业corpId
     */
    public $union_corp_id;

    /**
     * 加入企业的企业名称
     */
    public $union_org_name;

    /**
     * 加入的方式：1全部加入(不需要选择部门和员工) 2部分加入
     */
    public $union_type;

    /**
     * 单独加入的员工(所在部门不需要加入的情况，直接选择的几个员工)
     */
    public $userids;
}
