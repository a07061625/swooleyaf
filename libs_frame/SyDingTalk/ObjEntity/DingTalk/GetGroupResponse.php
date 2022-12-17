<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 出参
 *
 * @author auto create
 */
class GetGroupResponse
{
    /**
     * 群名称
     */
    public $group_name;

    /**
     * 入群二维码
     */
    public $group_url;

    /**
     * 开放群ID
     */
    public $open_conversationid;

    /**
     * 开放服务群群组id
     */
    public $open_groupsetid;

    /**
     * 开放服务群团队id
     */
    public $open_teamid;

    /**
     * 服务群机器人Code
     */
    public $robot_code;

    /**
     * 服务群机器人名称
     */
    public $robot_name;
}
