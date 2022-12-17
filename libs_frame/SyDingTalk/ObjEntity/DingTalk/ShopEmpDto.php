<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 卖家绑定的员工list
 *
 * @author auto create
 */
class ShopEmpDto
{
    /**
     * 主子账号
     */
    public $emp_type;

    /**
     * 员工姓名
     */
    public $name;

    /**
     * 卖家ID
     */
    public $outer_id;

    /**
     * 卖家子账号ID
     */
    public $outer_sub_id;

    /**
     * 绑定淘宝账号nick
     */
    public $seller_nick;

    /**
     * staffId
     */
    public $userid;
}
