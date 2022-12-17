<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 时间段列表
 *
 * @author auto create
 */
class SetionTimeVO
{
    /**
     * 打卡时间跨度
     */
    public $across;

    /**
     * 打卡时间
     */
    public $check_time;

    /**
     * 打卡类型枚举（Onduty和OffDuty）
     */
    public $check_type;
}
