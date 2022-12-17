<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 识别用户数据
 *
 * @author auto create
 */
class DidoFaceVO
{
    /**
     * 终端识别有效期截止时间 timestamp(毫秒)
     */
    public $end_date;

    /**
     * 识别用照片id，安全考虑，获取成功后立即删除
     */
    public $media_id;

    /**
     * 终端识别有效期开始时间 timestamp(毫秒)
     */
    public $start_date;

    /**
     * 用户类型，用于区别不同的识别问候语 如interview,friends,business,communication,training,inspection,other
     */
    public $user_type;

    /**
     * 用户id
     */
    public $userid;
}
