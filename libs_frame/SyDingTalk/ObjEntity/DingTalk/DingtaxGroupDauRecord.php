<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果返回一个记录列表，列表中每一项包含union_id，open_conversation_id，stat_date三个属性
 *
 * @author auto create
 */
class DingtaxGroupDauRecord
{
    /**
     * 开放群ID
     */
    public $open_conversation_id;

    /**
     * 统计日期(格式为 yyyymmdd)
     */
    public $stat_date;

    /**
     * 用户的unionId
     */
    public $union_id;
}
