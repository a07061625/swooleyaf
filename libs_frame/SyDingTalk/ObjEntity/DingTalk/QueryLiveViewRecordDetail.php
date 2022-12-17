<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回结果
 *
 * @author auto create
 */
class QueryLiveViewRecordDetail
{
    /**
     * 部门id
     */
    public $dept_id;

    /**
     * 群名称
     */
    public $group_name;

    /**
     * 是否分页拉取完成，true：完成
     */
    public $has_more;

    /**
     * 直播uuid
     */
    public $live_uuid;

    /**
     * 用户观看记录
     */
    public $record_list;

    /**
     * 直播标题
     */
    public $title;
}
