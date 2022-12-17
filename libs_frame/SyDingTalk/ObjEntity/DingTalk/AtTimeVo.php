<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 时间段列表
 *
 * @author auto create
 */
class AtTimeVo
{
    /**
     * 是否跨天
     */
    public $across;

    /**
     * 允许开始分钟
     */
    public $begin_min;

    /**
     * 打卡时间
     */
    public $check_time;

    /**
     * 打卡类型枚举（Onduty和OffDuty）
     */
    public $check_type;

    /**
     * 允许结束分钟
     */
    public $end_min;
}
