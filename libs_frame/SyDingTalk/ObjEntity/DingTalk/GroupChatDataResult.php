<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果对象
 *
 * @author auto create
 */
class GroupChatDataResult
{
    /**
     * 是否来自缓存
     */
    public $from_cache;

    /**
     * 是否被限流
     */
    public $is_block;

    /**
     * 活跃数据对象
     */
    public $rawset;

    /**
     * 执行时间
     */
    public $runtime;
}
