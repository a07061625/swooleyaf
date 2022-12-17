<?php

namespace SyDingTalk\Oapi\SmartWork;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartwork.hrm.employee.queryonjob request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class HrmEmployeeQueryOnJobRequest extends BaseRequest
{
    /**
     * 分页起始值，默认0开始
     */
    private $offset;
    /**
     * 分页大小，最大50
     */
    private $size;
    /**
     * 在职员工子状态筛选。2，试用期；3，正式；5，待离职；-1，无状态
     */
    private $statusList;

    public function setOffset($offset)
    {
        $this->offset = $offset;
        $this->apiParas['offset'] = $offset;
    }

    public function getOffset()
    {
        return $this->offset;
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
        return 'dingtalk.oapi.smartwork.hrm.employee.queryonjob';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->offset, 'offset');
        RequestCheckUtil::checkMinValue($this->offset, 0, 'offset');
        RequestCheckUtil::checkNotNull($this->size, 'size');
        RequestCheckUtil::checkMaxValue($this->size, 50, 'size');
        RequestCheckUtil::checkMinValue($this->size, 1, 'size');
        RequestCheckUtil::checkNotNull($this->statusList, 'statusList');
        RequestCheckUtil::checkMaxListSize($this->statusList, 20, 'statusList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
