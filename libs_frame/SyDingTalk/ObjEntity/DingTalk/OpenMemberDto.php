<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果
 *
 * @author auto create
 */
class OpenMemberDto
{
    /**
     * 组织id
     */
    public $corp_id;

    /**
     * 配合fromCorpId，在那个组织内的userid
     */
    public $from_corp_id;

    /**
     * 配合fromCorpId，在那个组织内的userid
     */
    public $from_userid;

    /**
     * 角色
     */
    public $tags;

    /**
     * 成员id
     */
    public $userid;
}
