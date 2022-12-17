<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 列表
 *
 * @author auto create
 */
class FormInstanceResponse
{
    /**
     * 毫秒级时间戳，填表提交时间
     */
    public $create_time;

    /**
     * 表单内容列表
     */
    public $forms;

    /**
     * 毫秒级时间戳，填表更新时间
     */
    public $modify_time;

    /**
     * 提交人姓名
     */
    public $submitter_user_name;

    /**
     * 提交人userid
     */
    public $submitter_userid;
}
