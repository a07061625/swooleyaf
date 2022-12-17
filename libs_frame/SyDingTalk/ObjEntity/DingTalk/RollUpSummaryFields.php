<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 对MasterDetail类型有效：roll-up summary字段列表
 *
 * @author auto create
 */
class RollUpSummaryFields
{
    /**
     * 汇总方法
     */
    public $aggregator;

    /**
     * 需要汇总的明细内字段名
     */
    public $name;
}
