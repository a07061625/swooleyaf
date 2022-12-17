<?php

namespace SyDingTalk\Oapi\Workspace;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.workspace.auditlog.list request
 *
 * @author auto create
 *
 * @since 1.0, 2021.07.07
 */
class AuditLogListRequest extends BaseRequest
{
    /**
     * 操作日志截止时间，unix时间戳，单位ms
     */
    private $endDate;
    /**
     * 操作记录文件id，作为分页偏移量，与load_more_gmt_create一起使用，返回记录的biz_id为load_more_biz_id且gmt_create为load_more_gmt_create之后的操作列表，分页查询获取下一页时，传最后一条记录的biz_id和gmt_create。
     */
    private $loadMoreBizId;
    /**
     * 操作记录生成时间，作为分页偏移量，分页查询时必传，unix时间戳，单位ms
     */
    private $loadMoreGmtCreate;
    /**
     * 操作列表长度，最大500
     */
    private $pageSize;
    /**
     * 操作日志起始时间，unix时间戳，单位ms
     */
    private $startDate;

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
        $this->apiParas['end_date'] = $endDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setLoadMoreBizId($loadMoreBizId)
    {
        $this->loadMoreBizId = $loadMoreBizId;
        $this->apiParas['load_more_bizId'] = $loadMoreBizId;
    }

    public function getLoadMoreBizId()
    {
        return $this->loadMoreBizId;
    }

    public function setLoadMoreGmtCreate($loadMoreGmtCreate)
    {
        $this->loadMoreGmtCreate = $loadMoreGmtCreate;
        $this->apiParas['load_more_gmt_create'] = $loadMoreGmtCreate;
    }

    public function getLoadMoreGmtCreate()
    {
        return $this->loadMoreGmtCreate;
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

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        $this->apiParas['start_date'] = $startDate;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.workspace.auditlog.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->endDate, 'endDate');
        RequestCheckUtil::checkNotNull($this->pageSize, 'pageSize');
        RequestCheckUtil::checkNotNull($this->startDate, 'startDate');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
