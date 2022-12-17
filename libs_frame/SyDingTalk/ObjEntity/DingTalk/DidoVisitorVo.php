<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 预约数据
 *
 * @author auto create
 */
class DidoVisitorVo
{
    /**
     * 预约开始时间
     */
    public $appointed_endtime;

    /**
     * 预约结束时间
     */
    public $appointed_starttime;

    /**
     * 扩展信息
     */
    public $extra_info;

    /**
     * 可识别照片
     */
    public $media_id;

    /**
     * 访客手机号
     */
    public $mobile;

    /**
     * 通知用户ID
     */
    public $notify_user_list;

    /**
     * 识别开始时间
     */
    public $recognize_endtime;

    /**
     * 识别结束时间
     */
    public $recognize_starttime;

    /**
     * 访客姓名
     */
    public $user_name;

    /**
     * 来访目的
     */
    public $user_type;

    /**
     * 访客外部联系人ID
     */
    public $userid;
}
