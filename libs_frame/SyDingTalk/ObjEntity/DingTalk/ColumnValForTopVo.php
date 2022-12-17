<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 列信息与列值数据
 *
 * @author auto create
 */
class ColumnValForTopVo
{
    /**
     * 列值数据
     */
    public $column_vals;

    /**
     * 列信息
     */
    public $column_vo;

    /**
     * 一些不需要计算得固定值，如出勤天数等
     */
    public $fixed_value;
}
