<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 绑定人员信息
 *
 * @author auto create
 */
class OpenOrgEntityDo
{
    /**
     * 企业id
     */
    public $corpid;

    /**
     * 用户/部门/角色id
     */
    public $entity_id;

    /**
     * 人员类型：1用户，2部门，3角色
     */
    public $entity_type;

    /**
     * 用户/部门/角色名称
     */
    public $name;

    /**
     * 角色/部门下面员工人数
     */
    public $user_num;
}
