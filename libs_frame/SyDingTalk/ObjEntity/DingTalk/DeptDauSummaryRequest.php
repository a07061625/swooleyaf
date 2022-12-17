<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求参数对象
 *
 * @author auto create
 */
class DeptDauSummaryRequest
{
    /**
     * 分页游标；首页请使用0，之后直接使用返回结果中的next_cursor
     */
    public $cursor;

    /**
     * 日期标识
     */
    public $data_id;

    /**
     * 请求的部门id
     */
    public $dept_id;

    /**
     * 分页大小;不超过100
     */
    public $size;

    /**
     * 请求部门的父部门id
     */
    public $super_dept_id;
}
