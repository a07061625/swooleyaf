<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回结果
 *
 * @author auto create
 */
class UserGetByUnionIdResponse
{
    /**
     * 联系类型，0 企业内部员工 1 企业外部联系人
     */
    public $contact_type;

    /**
     * 用户id
     */
    public $userid;
}
