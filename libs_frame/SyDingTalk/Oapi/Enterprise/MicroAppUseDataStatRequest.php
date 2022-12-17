<?php

namespace SyDingTalk\Oapi\Enterprise;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.enterprise.microapp.usedata.stat request
 *
 * @author auto create
 *
 * @since 1.0, 2019.08.05
 */
class MicroAppUseDataStatRequest extends BaseRequest
{
    /**
     * 企业ID
     */
    private $corpId;
    /**
     * 排序
     */
    private $orderBy;
    /**
     * 分页查询条数，最多30条
     */
    private $pageSize;
    /**
     * 分页起始点
     */
    private $pageStart;
    /**
     * agent_name    组织微应用名称; open_micro_user_cnt_1d    最近1天打开微应用用户数; open_micro_user_cnt_1w    最近7天打开微应用用户数;
     */
    private $returnFields;
    /**
     * 查询时间
     */
    private $statDate;

    public function setCorpId($corpId)
    {
        $this->corpId = $corpId;
        $this->apiParas['corp_id'] = $corpId;
    }

    public function getCorpId()
    {
        return $this->corpId;
    }

    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
        $this->apiParas['order_by'] = $orderBy;
    }

    public function getOrderBy()
    {
        return $this->orderBy;
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

    public function setReturnFields($returnFields)
    {
        $this->returnFields = $returnFields;
        $this->apiParas['return_fields'] = $returnFields;
    }

    public function getReturnFields()
    {
        return $this->returnFields;
    }

    public function setStatDate($statDate)
    {
        $this->statDate = $statDate;
        $this->apiParas['stat_date'] = $statDate;
    }

    public function getStatDate()
    {
        return $this->statDate;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.enterprise.microapp.usedata.stat';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->corpId, 'corpId');
        RequestCheckUtil::checkNotNull($this->pageSize, 'pageSize');
        RequestCheckUtil::checkNotNull($this->pageStart, 'pageStart');
        RequestCheckUtil::checkNotNull($this->returnFields, 'returnFields');
        RequestCheckUtil::checkMaxListSize($this->returnFields, 20, 'returnFields');
        RequestCheckUtil::checkNotNull($this->statDate, 'statDate');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
