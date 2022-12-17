<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 开始时间
 *
 * @author auto create
 */
class DateTime
{
    /**
     * 日期，全天日程使用，格式必须为'yyyy-mm-dd',和timestamp字段互斥，该字段有值时，则忽略timestamp字段
     */
    public $date;

    /**
     * 时间戳，单位为秒。非全天日程使用，与date字段互斥
     */
    public $timestamp;

    /**
     * 时区信息，默认为"Asia/Shanghai"。date有值时，timezone 为 UTC；
     */
    public $timezone;
}
