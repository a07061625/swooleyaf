<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果集数据
 *
 * @author auto create
 */
class InviteDataModel
{
    /**
     * 渠道，"MARKET"表示通过营销的数据，其他是通过系统的方式进入
     */
    public $channel;

    /**
     * 组织机构id
     */
    public $corp_id;

    /**
     * 结果数据，场景ID，sence_id会放在这个地方
     */
    public $extension;

    /**
     * 修改时间，亦用于游标查询
     */
    public $gmt_modified;

    /**
     * 邀请人用户id
     */
    public $invite_userid;

    /**
     * 加入日期，格式：yyyyMMdd
     */
    public $join_at;

    /**
     * 状态.0表示无效（包括过程数据），1:表示有效
     */
    public $status;

    /**
     * 被邀请人用户id
     */
    public $userid;
}
