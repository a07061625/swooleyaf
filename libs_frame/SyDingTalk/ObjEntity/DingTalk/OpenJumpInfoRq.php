<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求对象
 *
 * @author auto create
 */
class OpenJumpInfoRq
{
    /**
     * 企业id
     */
    public $corpid;

    /**
     * 第三方行程id
     */
    public $itinerary_id;

    /**
     * 跳转类型：1机票，2火车票，3酒店
     */
    public $type;

    /**
     * 用户id
     */
    public $userid;
}
