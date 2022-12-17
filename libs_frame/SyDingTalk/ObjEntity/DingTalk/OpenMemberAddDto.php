<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 加人的成员列表
 *
 * @author auto create
 */
class OpenMemberAddDto
{
    /**
     * 成员来源组织
     */
    public $from_corp_id;

    /**
     * 来源组织成员userId
     */
    public $from_userid;

    /**
     * 目标组织userId
     */
    public $userid;
}
