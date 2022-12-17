<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 打卡事件结果模型
 *
 * @author auto create
 */
class UserEventResultOapiRequestVo
{
    /**
     * 打卡业务代码
     */
    public $biz_code;

    /**
     * 打卡业务实例id
     */
    public $biz_inst_id;

    /**
     * 打卡事件外部id，唯一键
     */
    public $event_id;

    /**
     * 是否失效当前事件，不可重复打卡:true，可重复打卡:false
     */
    public $invalid_event;

    /**
     * 打卡成功的位置信息
     */
    public $punch_position;

    /**
     * 打卡事件结果，2:成功，3:失败
     */
    public $result;

    /**
     * 员工id
     */
    public $userid;
}
