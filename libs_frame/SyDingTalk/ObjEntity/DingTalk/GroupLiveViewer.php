<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 列表数据项
 *
 * @author auto create
 */
class GroupLiveViewer
{
    /**
     * 观看直播时长（毫秒）
     */
    public $play_duration;

    /**
     * 观看直播时长（分钟）
     */
    public $play_duration_min;

    /**
     * 观看直播回放时长（毫秒）
     */
    public $play_record_duration;

    /**
     * 观看直播回放时长（分钟）
     */
    public $play_record_duration_min;

    /**
     * 员工在当前企业内的唯一标识，也称staffId。可由企业在创建时指定，并代表一定含义比如工号，创建后不可修改
     */
    public $userid;
}
