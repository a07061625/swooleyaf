<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 表单设置
 *
 * @author auto create
 */
class FormSchemaSettingVo
{
    /**
     * 业务类型
     */
    public $biz_type;

    /**
     * 收集类型，是表格收集还是表单收集
     */
    public $collection_type;

    /**
     * 填写结束时间/循环表单的循环结束时间
     */
    public $end_time;

    /**
     * 表单类型
     */
    public $form_type;

    /**
     * 循环周期
     */
    public $loop_day_of_weeks;

    /**
     * 提醒时间
     */
    public $loop_time;

    /**
     * 回复时间开关/循环周期启用
     */
    public $reply_time;

    /**
     * 子来源
     */
    public $sub_source;
}
