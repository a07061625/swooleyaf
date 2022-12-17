<?php

namespace SyDingTalk\Oapi\SmartWork;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartwork.hrm.employee.onjoblist.query request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.08
 */
class HrmEmployeeOnJobListQueryRequest extends BaseRequest
{
    /**
     * 分页起始值，默认0开始
     */
    private $cursor;
    /**
     * 查询参数
     */
    private $searchParam;
    /**
     * 分页大小，最大50
     */
    private $size;
    /**
     * 在职员工子状态筛选。2，试用期；3，正式；5，待离职；-1，无状态
     */
    private $statusList;

    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
        $this->apiParas['cursor'] = $cursor;
    }

    public function getCursor()
    {
        return $this->cursor;
    }

    public function setSearchParam($searchParam)
    {
        $this->searchParam = $searchParam;
        $this->apiParas['search_param'] = $searchParam;
    }

    public function getSearchParam()
    {
        return $this->searchParam;
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

    public function setStatusList($statusList)
    {
        $this->statusList = $statusList;
        $this->apiParas['status_list'] = $statusList;
    }

    public function getStatusList()
    {
        return $this->statusList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartwork.hrm.employee.onjoblist.query';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->cursor, 'cursor');
        RequestCheckUtil::checkNotNull($this->size, 'size');
        RequestCheckUtil::checkNotNull($this->statusList, 'statusList');
        RequestCheckUtil::checkMaxListSize($this->statusList, 999, 'statusList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
