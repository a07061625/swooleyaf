<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求数据块
 *
 * @author auto create
 */
class QueryUserRolesResponse
{
    /**
     * 非NULL列表;此员工在当前家校通讯录中的是班主任角色的班级列表
     */
    public $advisor;

    /**
     * 非NULL列表;此员工在当前家校通讯录中的是监护人角色的班级列表
     */
    public $guardian;

    /**
     * 非NULL列表;此员工在当前家校通讯录中的是学生角色的班级列表
     */
    public $student;

    /**
     * 非NULL列表;此员工在当前家校通讯录中的是老师角色的班级列表
     */
    public $teacher;

    /**
     * 员工id
     */
    public $userid;
}
