<?php

namespace SyDingTalk\Oapi\Kac;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.kac.openlive.record.list request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.22
 */
class OpenLiveRecordListRequest extends BaseRequest
{
    /**
     * 员工id
     */
    private $authorUserId;
    /**
     * 查询时间范围开始时间戳
     */
    private $beginTime;
    /**
     * 查询时间范围结束时间戳
     */
    private $endTime;
    /**
     * 分页大小，小于等于100
     */
    private $pageSize;
    /**
     * 第几页，从1开始
     */
    private $pageStart;
    /**
     * 直播状态：init: 未开播, living: 直播中，end: 直播已结束, null或空: 全体
     */
    private $status;

    public function setAuthorUserId($authorUserId)
    {
        $this->authorUserId = $authorUserId;
        $this->apiParas['author_user_id'] = $authorUserId;
    }

    public function getAuthorUserId()
    {
        return $this->authorUserId;
    }

    public function setBeginTime($beginTime)
    {
        $this->beginTime = $beginTime;
        $this->apiParas['begin_time'] = $beginTime;
    }

    public function getBeginTime()
    {
        return $this->beginTime;
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

    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
        $this->apiParas['page_size'] = $pageSize;
    }

    public function getPageSize()
    {
        return $this->pageSize;
    }

    public function setPageStart($pageStart)
    {
        $this->pageStart = $pageStart;
        $this->apiParas['page_start'] = $pageStart;
    }

    public function getPageStart()
    {
        return $this->pageStart;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->apiParas['status'] = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.kac.openlive.record.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->authorUserId, 'authorUserId');
        RequestCheckUtil::checkNotNull($this->pageSize, 'pageSize');
        RequestCheckUtil::checkNotNull($this->pageStart, 'pageStart');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
