<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 查询结果
 *
 * @author auto create
 */
class FaceGroupDto
{
    /**
     * M2上的定制UI
     */
    public $bg_img_url;

    /**
     * 业务id
     */
    public $biz_id;

    /**
     * 结束时间
     */
    public $end_time;

    /**
     * 识别成功后的问候语
     */
    public $greeting_msg;

    /**
     * 开始时间
     */
    public $start_time;

    /**
     * 识别组启用状态：1-已启用；2未启用；
     */
    public $status;

    /**
     * 识别组的标题
     */
    public $title;
}
