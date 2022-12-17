<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回值model
 *
 * @author auto create
 */
class OpenFeedWatchDetailRspModel
{
    /**
     * 是否还有数据没返回(0还有/1没有)
     */
    public $has_finish;

    /**
     * 观看数据列表
     */
    public $viewer_watch_details;
}
