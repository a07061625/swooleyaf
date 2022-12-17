<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 限时提交规则
 *
 * @author auto create
 */
class SubmitTimeRuleVo
{
    /**
     * 是否开启限时提交功能：仅且为true时开启
     */
    public $enable_time_limit;

    /**
     * 限制类型：before-提前；after-补交
     */
    public $time_type;

    /**
     * 时间单位：day-天；hour-小时
     */
    public $time_unit;

    /**
     * 限制值：timeUnit=day时，有效值范围[0~30] 天；timeUnit=hour时，有效值范围[0~24] 小时
     */
    public $time_value;
}
