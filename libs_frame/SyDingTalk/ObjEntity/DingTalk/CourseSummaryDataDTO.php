<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * list
 *
 * @author auto create
 */
class CourseSummaryDataDTO
{
    /**
     * 数据类别业务唯一键
     */
    public $category_biz_key;

    /**
     * 数据类别编码
     */
    public $category_code;

    /**
     * 课程编码
     */
    public $course_code;

    /**
     * 数据（key：数据因子编码，value： 对应的数据）
     */
    public $data;
}
