<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 年级列表
 *
 * @author auto create
 */
class OpenGrade
{
    /**
     * [0,无限)其下的班级数。尽量不要超过100个，否则页面性能有问题
     */
    public $classes;

    /**
     * 年级level
     */
    public $grade;

    /**
     * 年级名，与grade start_year需要对应
     */
    public $name;

    /**
     * 入学年份。请注意startyear name grade三者之间的关联关系
     */
    public $start_year;
}
