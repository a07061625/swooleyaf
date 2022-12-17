<?php

namespace SyDingTalk\Oapi\ServiceAccount;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.serviceaccount.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.16
 */
class ListRequest extends BaseRequest
{
    /**
     * 每页条数
     */
    private $pageSize;
    /**
     * 页码，第几页，从1开始算
     */
    private $pageStart;

    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
        $this->apiParas['pageSize'] = $pageSize;
    }

    public function getPageSize()
    {
        return $this->pageSize;
    }

    public function setPageStart($pageStart)
    {
        $this->pageStart = $pageStart;
        $this->apiParas['pageStart'] = $pageStart;
    }

    public function getPageStart()
    {
        return $this->pageStart;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.serviceaccount.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxValue($this->pageSize, 50, 'pageSize');
        RequestCheckUtil::checkMinValue($this->pageSize, 1, 'pageSize');
        RequestCheckUtil::checkMinValue($this->pageStart, 1, 'pageStart');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
