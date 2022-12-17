<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 集合子对象
 *
 * @author auto create
 */
class ListOpenLiveRecordRspModel
{
    /**
     * 直播ID
     */
    public $live_id;

    /**
     * 直播观看链接
     */
    public $live_link;

    /**
     * 公开类型 0: 不公开; 1: 完全公开; 2:组织内公开
     */
    public $public_type;

    /**
     * 预约开始时间戳
     */
    public $start_time;

    /**
     * 直播状态：init: 未开播, living: 直播中，end: 直播已结束
     */
    public $status;

    /**
     * 直播标题
     */
    public $title;
}
