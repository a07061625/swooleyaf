<?php

namespace SyDingTalk\Corp\Ding;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.ding.receiverstatus.list request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class ReceiverStatusListRequest extends BaseRequest
{
    /**
     * 确认状态，三种情况：不传表示查所有；传0表示查未确认状态；传1表示查已经确认状态；
     */
    private $confirmedStatus;
    /**
     * dingid
     */
    private $dingId;
    /**
     * 分页页码，从1开始
     */
    private $pageNo;
    /**
     * 每页显示数量，最大值50
     */
    private $pageSize;

    public function setConfirmedStatus($confirmedStatus)
    {
        $this->confirmedStatus = $confirmedStatus;
        $this->apiParas['confirmed_status'] = $confirmedStatus;
    }

    public function getConfirmedStatus()
    {
        return $this->confirmedStatus;
    }

    public function setDingId($dingId)
    {
        $this->dingId = $dingId;
        $this->apiParas['ding_id'] = $dingId;
    }

    public function getDingId()
    {
        return $this->dingId;
    }

    public function setPageNo($pageNo)
    {
        $this->pageNo = $pageNo;
        $this->apiParas['page_no'] = $pageNo;
    }

    public function getPageNo()
    {
        return $this->pageNo;
    }

    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
        $this->apiParas['page_size'] = $pageSize;
    }

    public function getPageSize()
    {
        return $this->pageSize;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.ding.receiverstatus.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->dingId, 'dingId');
        RequestCheckUtil::checkNotNull($this->pageNo, 'pageNo');
        RequestCheckUtil::checkNotNull($this->pageSize, 'pageSize');
        RequestCheckUtil::checkMaxValue($this->pageSize, 50, 'pageSize');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
