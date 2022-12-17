<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 分配信息修改明细列表
 *
 * @author auto create
 */
class AssignInfoModifyItem
{
    /**
     * 工序执行器分配列表
     */
    public $operation_executor_assigns;

    /**
     * 工序外部ID
     */
    public $operation_external_id;

    /**
     * 工序唯一ID
     */
    public $operation_uid;

    /**
     * 分配单元列表
     */
    public $work_units;
}
