<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 外部联系人信息
 *
 * @author auto create
 */
class OpenExtContact
{
    /**
     * 地址
     */
    public $address;

    /**
     * 企业名
     */
    public $company_name;

    /**
     * 负责人userId
     */
    public $follower_userid;

    /**
     * 标签列表
     */
    public $label_ids;

    /**
     * 名称
     */
    public $name;

    /**
     * 备注
     */
    public $remark;

    /**
     * 共享给的部门ID
     */
    public $share_dept_ids;

    /**
     * 共享给的员工userId列表
     */
    public $share_userids;

    /**
     * 职位
     */
    public $title;

    /**
     * 该外部联系人的userId
     */
    public $user_id;
}
