<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * course_infos
 *
 * @author auto create
 */
class CourseInfo
{
    /**
     * 业务唯一键，用于保证课程的唯一性，防止重复创建
     */
    public $biz_key;

    /**
     * 课程的结束时间，Unix毫秒时间戳
     */
    public $end_time;

    /**
     * 课程介绍
     */
    public $introduce;

    /**
     * 课程名称
     */
    public $name;

    /**
     * 课程选项信息
     */
    public $option;

    /**
     * 课程的开始时间，Unix毫秒时间戳
     */
    public $start_time;

    /**
     * 老师的组织CorpId
     */
    public $teacher_corpid;

    /**
     * 老师的用户ID
     */
    public $teacher_userid;
}
