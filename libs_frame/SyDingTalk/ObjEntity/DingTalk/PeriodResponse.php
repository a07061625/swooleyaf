<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * result
 *
 * @author auto create
 */
class PeriodResponse
{
    /**
     * 校区ID
     */
    public $campus_id;

    /**
     * 学段名称
     */
    public $name;

    /**
     * 学段名称类型，text表示文本型，如中学为七年级，八年级，九年级，number表示数字型，如初中一年级1班，二年级1班等
     */
    public $name_mode;

    /**
     * 学段别名
     */
    public $nick;

    /**
     * 学段ID
     */
    public $period_id;

    /**
     * 学段类型（幼儿园：kindergarten、小学：primary_school，初中：middle_school，高中：high_school）
     */
    public $period_type;
}
