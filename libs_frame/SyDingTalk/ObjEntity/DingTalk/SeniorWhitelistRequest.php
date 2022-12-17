<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 高管白名单设置请求对象
 *
 * @author auto create
 */
class SeniorWhitelistRequest
{
    /**
     * 高管白名单部门列表
     */
    public $senior_permit_deptids;

    /**
     * 高管白名单角色列表
     */
    public $senior_permit_roleids;

    /**
     * 高管白名单员工列表
     */
    public $senior_permit_userids;

    /**
     * 高管工号
     */
    public $senior_userid;
}
