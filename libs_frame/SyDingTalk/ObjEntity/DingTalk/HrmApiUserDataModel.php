<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 员工信息对象，被操作人userid是必填
 *
 * @author auto create
 */
class HrmApiUserDataModel
{
    /**
     * 数据项描述信息
     */
    public $data_desc;

    /**
     * 数据值,可以为数值或者字符串
     */
    public $data_value;

    /**
     * 被操作人userid
     */
    public $userid;
}
