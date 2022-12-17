<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回结果
 *
 * @author auto create
 */
class UserGetByCodeResponse
{
    /**
     * 用户统一id
     */
    public $associated_unionid;

    /**
     * 设备id
     */
    public $device_id;

    /**
     * 用户名字
     */
    public $name;

    /**
     * 是否为管理员
     */
    public $sys;

    /**
     * 员工级别。 1：主管理员 2：子管理员 100：老板 0：其他（如普通员工）
     */
    public $sys_level;

    /**
     * 用户unionId
     */
    public $unionid;

    /**
     * 用户id
     */
    public $userid;
}
