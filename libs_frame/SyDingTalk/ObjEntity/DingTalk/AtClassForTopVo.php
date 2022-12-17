<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回对象
 *
 * @author auto create
 */
class AtClassForTopVo
{
    /**
     * 考勤组班次配置
     */
    public $class_setting;

    /**
     * 组织id
     */
    public $corp_id;

    /**
     * classid
     */
    public $id;

    /**
     * 组织名称
     */
    public $name;

    /**
     * 班次打卡时间段,最多
     */
    public $sections;

    /**
     * 固定班次的工作日班次
     */
    public $work_days;
}
