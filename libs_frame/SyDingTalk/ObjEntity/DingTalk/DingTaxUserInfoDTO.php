<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 运营数据
 *
 * @author auto create
 */
class DingTaxUserInfoDTO
{
    /**
     * Y/N;Y代表新增用户，N代表存量用户
     */
    public $new_user;

    /**
     * 自然人/企业/个体户
     */
    public $taxation_type;

    /**
     * 手机号
     */
    public $user_mobile;

    /**
     * CW/FR
     */
    public $user_role;
}
