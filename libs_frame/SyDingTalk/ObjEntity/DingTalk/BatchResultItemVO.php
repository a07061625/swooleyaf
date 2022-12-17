<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 操作结果项列表
 *
 * @author auto create
 */
class BatchResultItemVO
{
    /**
     * 错误码
     */
    public $error_code;

    /**
     * 错误描述
     */
    public $error_msg;

    /**
     * 下标（从0开始）
     */
    public $index;

    /**
     * 职位
     */
    public $item;

    /**
     * 是否成功
     */
    public $success;
}
