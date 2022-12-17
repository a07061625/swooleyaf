<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * result
 *
 * @author auto create
 */
class AsyncSendProgress
{
    /**
     * 取值 0-100，表示处理的百分比
     */
    public $progress_in_percent;

    /**
     * 任务执行状态,0=未开始,1=处理中,2=处理完毕
     */
    public $status;
}
