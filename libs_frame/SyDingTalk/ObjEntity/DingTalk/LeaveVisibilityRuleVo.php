<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 该假期类型的“适用范围”规则列表
 *
 * @author auto create
 */
class LeaveVisibilityRuleVo
{
    /**
     * 规则类型：dept-部门；staff-员工；label-角色
     */
    public $type;

    /**
     * 规则数据：当type=staff时，为员工userId列表；当type=dept时，为部门id列表；当type=label时，为角色id列表
     */
    public $visible;
}
