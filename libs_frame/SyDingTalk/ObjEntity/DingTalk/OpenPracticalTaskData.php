<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 实操任务完成信息
 *
 * @author auto create
 */
class OpenPracticalTaskData
{
    /**
     * true表示完成，false表示未完成
     */
    public $finish;

    /**
     * 实操任务code，sendCard表示发布打卡，sendImMsg表示发布消息
     */
    public $task_code;
}
