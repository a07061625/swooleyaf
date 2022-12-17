<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 模版对象
 *
 * @author auto create
 */
class ProcessSimpleVO
{
    /**
     * 关联考勤类型 ，0: 无 ；1：补卡申请 ；2：请假。。。
     */
    public $attendance_type;

    /**
     * 模版名
     */
    public $flow_title;

    /**
     * 修改时间
     */
    public $gmt_modified;

    /**
     * 图标名
     */
    public $icon_name;

    /**
     * 图标地址
     */
    public $icon_url;

    /**
     * 是否新模版
     */
    public $is_new_process;

    /**
     * 模版code
     */
    public $process_code;
}
