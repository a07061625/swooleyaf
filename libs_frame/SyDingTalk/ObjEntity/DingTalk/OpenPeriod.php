<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 学段列表
 *
 * @author auto create
 */
class OpenPeriod
{
    /**
     * 年级列表
     */
    public $grades;

    /**
     * number: 初中按照1,2,3年级命名。默认。  text: 初中按照6,7,8,9年级命名
     */
    public $name_mode;

    /**
     * 学段code。幼儿园：kindergarten  小学：primary_school  初中：  middle_school  高中：  high_school
     */
    public $period_code;

    /**
     * 学段名；幼儿园：kindergarten  小学：primary_school  初中：  middle_school  高中：  high_school
     */
    public $step;
}
