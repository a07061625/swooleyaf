<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 考勤组中的班次列表
 *
 * @author auto create
 */
class AtClassVo
{
    /**
     * 班次id
     */
    public $class_id;

    /**
     * 班次名称
     */
    public $name;

    /**
     * 班次中上下班列表
     */
    public $sections;

    /**
     * 班次配置
     */
    public $setting;
}
