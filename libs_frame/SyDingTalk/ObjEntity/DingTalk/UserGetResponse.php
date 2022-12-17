<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 业务返回结果
 *
 * @author auto create
 */
class UserGetResponse
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
     * 员工在对应的部门中的排序。
     */
    public $dept_order_list;

    /**
     * 任职信息
     */
    public $dept_position_list;

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
     * 专属帐号类型：{sso: 企业自定义idp;dingtalk: 钉钉idp}
     */
    public $exclusive_account_type;

    /**
     * 扩展属性，长度最大2000个字符。可以设置多种属性（手机上最多显示10个扩展属性，具体显示哪些属性，请到OA管理后台->设置->通讯录信息设置和OA管理后台->设置->手机端显示信息设置）。 该字段的值支持链接类型填写，同时链接支持变量通配符自动替换，目前支持通配符有：userid，corpid。示例： [工位地址](http://www.dingtalk.com?userid=#userid#&corpid=#corpid#)
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
     * 员工在对应的部门中是否领导。
     */
    public $leader_in_dept;

    /**
     * 本组织专属帐号登录名
     */
    public $login_id;

    /**
     * 主管的ID，仅限企业内部开发调用
     */
    public $manager_userid;

    /**
     * 手机号码
     */
    public $mobile;

    /**
     * 员工名称
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
     * 企业邮箱类型（profession：标准版，base：基础版）
     */
    public $org_email_type;

    /**
     * 是否实名认证
     */
    public $real_authed;

    /**
     * 备注
     */
    public $remark;

    /**
     * 角色列表
     */
    public $role_list;

    /**
     * 是否高管
     */
    public $senior;

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
     * 关联信息
     */
    public $union_emp_ext;

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
