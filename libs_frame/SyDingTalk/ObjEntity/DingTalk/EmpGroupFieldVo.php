<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 花名册分组
 *
 * @author auto create
 */
class EmpGroupFieldVo
{
    /**
     * 分组标识
     */
    public $group_id;

    /**
     * 分组下明细（非明细分组仅一条明细）
     */
    public $sections;
}
