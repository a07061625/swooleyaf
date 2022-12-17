<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果集数据
 *
 * @author auto create
 */
class PointHistoryDTO
{
    /**
     * 组织ID
     */
    public $corp_id;

    /**
     * 创建时间（精确到毫秒数）
     */
    public $create_at;

    /**
     * 对应的行为代码（可空）
     */
    public $rule_code;

    /**
     * 对应的行为描述
     */
    public $rule_name;

    /**
     * 增加或减少的分数（增加为正数，减少为负数）
     */
    public $score;

    /**
     * 用户id
     */
    public $userid;

    /**
     * 幂等键
     */
    public $uuid;
}
