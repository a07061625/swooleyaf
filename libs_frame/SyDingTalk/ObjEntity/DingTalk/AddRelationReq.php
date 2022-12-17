<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 关系
 *
 * @author auto create
 */
class AddRelationReq
{
    /**
     * 时间戳精确到毫秒
     */
    public $begin_time;

    /**
     * 接收者钉钉的openid
     */
    public $dst_im_openid;

    /**
     * 时间戳精确到毫秒
     */
    public $end_time;

    /**
     * 是否双向关系
     */
    public $is_double_way;

    /**
     * 发送者钉钉的openid
     */
    public $src_im_openid;
}
