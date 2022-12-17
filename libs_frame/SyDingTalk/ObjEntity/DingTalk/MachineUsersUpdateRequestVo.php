<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 变更智能考勤机员工参数模型
 *
 * @author auto create
 */
class MachineUsersUpdateRequestVo
{
    /**
     * 新增的员工id列表
     */
    public $add_userid_list;

    /**
     * 移除的员工id列表
     */
    public $del_userid_list;

    /**
     * 设备唯一标识id列表，字符串数组
     */
    public $deviceid_list;

    /**
     * 设备唯一标识id列表，Long数组
     */
    public $devid_list;
}
