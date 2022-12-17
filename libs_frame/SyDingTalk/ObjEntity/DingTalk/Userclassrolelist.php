<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 用户所有班级的角色列表
 *
 * @author auto create
 */
class Userclassrolelist
{
    /**
     * 所在班级ID
     */
    public $class_id;

    /**
     * 班级名称
     */
    public $class_name;

    /**
     * 组织id
     */
    public $corp_id;

    /**
     * 所在班级的姓名( 如果当前用户在班上为老师，则为老师姓名 ;如果当前用户在班上为家长， 则为孩子的学生姓名; 如果当前用户在班上为学生，则为学生姓名 )
     */
    public $name;

    /**
     * 学校的地址信息(如果有)
     */
    public $org_location;

    /**
     * 学校名称(如果有)
     */
    public $org_name;

    /**
     * 所在班级的角色(学生:student，老师: teacher)
     */
    public $role_name;

    /**
     * 所在班级的员工ID。 如果当前用户在班上为老师， 则为老师的员工ID; 如果当前用户在班上为家长， 则为孩子的学生员工ID; 如果当前用户在班上为学生， 则为学生的员工ID
     */
    public $user_id;
}
