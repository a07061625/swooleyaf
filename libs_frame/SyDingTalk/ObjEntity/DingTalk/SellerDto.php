<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 组织绑定卖家List
 *
 * @author auto create
 */
class SellerDto
{
    /**
     * 卖家ID
     */
    public $seller_id;

    /**
     * 卖家昵称
     */
    public $seller_nick;

    /**
     * 卖家绑定的员工list
     */
    public $shop_emp_list;

    /**
     * 天猫店 淘宝店
     */
    public $type;

    /**
     * staffId
     */
    public $userid;
}
