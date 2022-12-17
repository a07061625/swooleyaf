<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * list
 *
 * @author auto create
 */
class CourseVO
{
    /**
     * 业务唯一键
     */
    public $biz_key;

    /**
     * list
     */
    public $classrooms;

    /**
     * 课程编码
     */
    public $code;

    /**
     * 创建者的组织CorpId
     */
    public $creator_corpid;

    /**
     * 创建者的用户ID
     */
    public $creator_userid;

    /**
     * 创建者的用户名
     */
    public $creator_username;

    /**
     * 结束时间，Unix毫秒时间戳
     */
    public $end_time;

    /**
     * 课程扩展信息
     */
    public $ext_info;

    /**
     * 课程介绍
     */
    public $introduce;

    /**
     * 课程名称
     */
    public $name;

    /**
     * 新版在线课堂
     */
    public $platform;

    /**
     * 开始时间，Unix毫秒时间戳
     */
    public $start_time;

    /**
     * 课程状态 -1取消，0未开始，1进行中，2已结束
     */
    public $status;

    /**
     * 老的的组织CorpId
     */
    public $teacher_corpid;

    /**
     * 老师的用户ID
     */
    public $teacher_userid;

    /**
     * 老师的用户名
     */
    public $teacher_username;
}
