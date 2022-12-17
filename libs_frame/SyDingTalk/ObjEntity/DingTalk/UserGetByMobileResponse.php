<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回结果
 *
 * @author auto create
 */
class UserGetByMobileResponse
{
    /**
     * 专属帐号员工的userid列表(不含其他组织创建的专属帐号)
     */
    public $exclusive_account_userid_list;

    /**
     * 员工id
     */
    public $userid;
}
