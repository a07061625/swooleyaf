<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 查询直播参数
 *
 * @author auto create
 */
class GroupLiveRecordReq
{
    /**
     * 直播所属群对应的部门
     */
    public $dept_id;

    /**
     * 结束时间，单位秒
     */
    public $end_time;

    /**
     * 开始时间，单位秒
     */
    public $start_time;
}
