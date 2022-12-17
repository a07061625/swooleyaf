<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * list
 *
 * @author auto create
 */
class CourseDetailDataDTO
{
    /**
     * 数据业务唯一键（比如标识具体哪一次进入教室）
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
     * 数据因子编码
     */
    public $factor_code;

    /**
     * 用户组织ID
     */
    public $user_cropid;

    /**
     * 用户ID
     */
    public $userid;

    /**
     * 数据值（比如进入教室的时间戳）
     */
    public $value;
}
