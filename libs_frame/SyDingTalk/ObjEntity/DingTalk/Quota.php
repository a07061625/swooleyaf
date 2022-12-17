<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 失败记录
 *
 * @author auto create
 */
class Quota
{
    /**
     * 假期类型唯一标识
     */
    public $leave_code;

    /**
     * 额度所对应的周期(除了假期类型为调休的时候可以为空之外 其他情况均不能为空 且格式必须满足"yyyy")
     */
    public $quota_cycle;

    /**
     * 员工ID
     */
    public $userid;
}
