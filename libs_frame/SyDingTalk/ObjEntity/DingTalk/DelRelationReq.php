<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 关系
 *
 * @author auto create
 */
class DelRelationReq
{
    /**
     * 接受者的im的openid
     */
    public $dst_im_openid;

    /**
     * 是否双向关系
     */
    public $is_double_way;

    /**
     * 发送者的im的openid
     */
    public $src_im_openid;
}
