<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求参数对象
 *
 * @author auto create
 */
class ImSummaryRequest
{
    /**
     * 分页大小;不超过100
     */
    public $cursor;

    /**
     * 日期标识
     */
    public $data_id;

    /**
     * 分页游标；首页请使用0，之后直接使用返回结果中的next_cursor
     */
    public $size;
}
