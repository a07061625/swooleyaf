<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 用户信息列表
 *
 * @author auto create
 */
class ListUserResponse
{
    /**
     * 是否激活
     */
    public $active;

    /**
     * 是否管理员
     */
    public $admin;

    /**
     * 头像
     */
    public $avatar;

    /**
     * 是否老板
     */
    public $boss;

    /**
     * 所属部门id列表
     */
    public $dept_id_list;

    /**
     * 员工在部门中的排序。
     */
    public $dept_order;

    /**
     * 员工邮箱
     */
    public $email;

    /**
     * 是否专属帐号
     */
    public $exclusive_account;

    /**
     * 专属帐号归属组织的组织id
     */
    public $exclusive_account_corp_id;

    /**
     * 专属帐号归属组织的组织名称
     */
    public $exclusive_account_corp_name;

    /**
     * 专属帐号类型
     */
    public $exclusive_account_type;

    /**
     * 扩展属性
     */
    public $extension;

    /**
     * 是否号码隐藏。隐藏手机号后，手机号在个人资料页隐藏，但仍可对其发DING、发起钉钉免费商务电话。
     */
    public $hide_mobile;

    /**
     * 入职时间，Unix时间戳，单位ms。
     */
    public $hired_date;

    /**
     * 员工工号
     */
    public $job_number;

    /**
     * 是否领导
     */
    public $leader;

    /**
     * 本组织专属帐号登录名
     */
    public $login_id;

    /**
     * 手机号码
     */
    public $mobile;

    /**
     * 用户姓名
     */
    public $name;

    /**
     * 查询本组织专属帐号时可获得昵称
     */
    public $nickname;

    /**
     * 员工的企业邮箱
     */
    public $org_email;

    /**
     * 备注
     */
    public $remark;

    /**
     * 国际电话区号
     */
    public $state_code;

    /**
     * 分机号
     */
    public $telephone;

    /**
     * 职位
     */
    public $title;

    /**
     * 员工在当前开发者企业账号范围内的唯一标识
     */
    public $unionid;

    /**
     * 用户id
     */
    public $userid;

    /**
     * 办公地点
     */
    public $work_place;
}
