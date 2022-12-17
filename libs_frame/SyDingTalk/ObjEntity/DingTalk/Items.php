<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 日程的实体
 *
 * @author auto create
 */
class Items
{
    /**
     * 参与者,考虑性能问题，该字段不向外透出
     */
    public $attendees;

    /**
     * 创建时间
     */
    public $created;

    /**
     * 内容描述
     */
    public $description;

    /**
     * 结束时间
     */
    public $end;

    /**
     * 日程事件id
     */
    public $id;

    /**
     * 地点
     */
    public $location;

    /**
     * 组织者
     */
    public $organizer;

    /**
     * 循环的规则
     */
    public $recurrence;

    /**
     * 循环日程中对应的序列id
     */
    public $recurrence_id;

    /**
     * 响应状态（accepted, declined, needsAction）
     */
    public $response_status;

    /**
     * 开始时间
     */
    public $start;

    /**
     * 状态（confirmed、cancelled）
     */
    public $status;

    /**
     * 标题简述
     */
    public $summary;

    /**
     * 日程的唯一ID, 周期日程的所有序列的unique_id为同一个
     */
    public $unique_id;

    /**
     * 最后一次更新时间
     */
    public $updated;
}
