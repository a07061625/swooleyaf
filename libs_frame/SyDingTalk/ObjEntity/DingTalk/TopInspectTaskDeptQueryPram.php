<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求入参
 *
 * @author auto create
 */
class TopInspectTaskDeptQueryPram
{
    /**
     * 游标，从返回结果中获取，第一次请求可为空
     */
    public $cursor;

    /**
     * 部门id，从通讯录接口获取
     */
    public $dept_id;

    /**
     * 请求开始时间，时间戳，单位毫秒
     */
    public $end_date;

    /**
     * 分页请求数量，最大值50
     */
    public $size;

    /**
     * 请求结束时间，时间戳，单位毫秒
     */
    public $start_date;

    /**
     * 请求的状态列表，1已签到，2已正常签退，3已异常签退
     */
    public $status;
}
