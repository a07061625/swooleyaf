<?php

namespace SyDingTalk\Oapi\CheckIn;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.checkin.record request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class RecordRequest extends BaseRequest
{
    /**
     * 部门id（1 表示根部门）
     */
    private $departmentId;
    /**
     * 开始时间，精确到毫秒，注意字段的位数 例：1520956800000
     */
    private $endTime;
    /**
     * 支持分页查询，与size 参数同时设置时才生效，此参数代表偏移量，从0 开始
     */
    private $offset;
    /**
     * 排序，asc 为正序，desc 为倒序
     */
    private $order;
    /**
     * 支持分页查询，与offset 参数同时设置时才生效，此参数代表分页大小，最大100
     */
    private $size;
    /**
     * 结束时间，精确到毫秒，注意字段的位数 例：1520956800000（默认为当前时间）
     */
    private $startTime;

    public function setDepartmentId($departmentId)
    {
        $this->departmentId = $departmentId;
        $this->apiParas['department_id'] = $departmentId;
    }

    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        $this->apiParas['end_time'] = $endTime;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
        $this->apiParas['offset'] = $offset;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function setOrder($order)
    {
        $this->order = $order;
        $this->apiParas['order'] = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setSize($size)
    {
        $this->size = $size;
        $this->apiParas['size'] = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        $this->apiParas['start_time'] = $startTime;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.checkin.record';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
