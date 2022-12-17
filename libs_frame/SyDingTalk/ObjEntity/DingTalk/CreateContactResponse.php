<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 联系人信息
 *
 * @author auto create
 */
class CreateContactResponse
{
    /**
     * 联系人实例ID
     */
    public $contact_instance_id;

    /**
     * 联系人unionId，自建应用视情况返回
     */
    public $contact_unionid;

    /**
     * 联系人在客户通讯录的ID
     */
    public $contact_userid;
}
