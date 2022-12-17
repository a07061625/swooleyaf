<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 批量操作结果
 *
 * @author auto create
 */
class BatchResultVo
{
    /**
     * 失败数量
     */
    public $failed_count;

    /**
     * 操作结果项列表
     */
    public $result;

    /**
     * 成功数量
     */
    public $success_count;

    /**
     * 总数量
     */
    public $total_count;
}
