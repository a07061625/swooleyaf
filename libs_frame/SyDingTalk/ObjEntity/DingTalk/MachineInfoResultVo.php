<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 查询智能考勤机列表结果模型
 *
 * @author auto create
 */
class MachineInfoResultVo
{
    /**
     * 分页查询中，后页是否还有数据
     */
    public $has_more;

    /**
     * 考勤机列表
     */
    public $machine_list;
}
