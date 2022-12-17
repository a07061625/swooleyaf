<?php

namespace SyDingTalk\Oapi\Enterprise;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.enterprise.subarea.totaldata.stat request
 *
 * @author auto create
 *
 * @since 1.0, 2020.03.10
 */
class SubareaTotalDataStatRequest extends BaseRequest
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
     * act_ratio_1d_001    所辖区域活跃率; act_usr_cnt_1d_001    活跃用户数最近1天; active_mbr_cnt_std_001    历史截至当日激活会员数; active_mbr_ratio    所辖区域用户的激活率; city_lat    所属城市维度; city_lng    所属城市经度; county_lat    区/县纬度; county_lng    区/县经度; mbr_cnt_std_063    历史截至当日企业会员数; online_org_cnt    所辖区域在线组织数    ; org_online_ratio    所辖区域组织覆盖率    ; real_org_cnt    所辖区域实际组织数    ; send_message_cnt_1d    发送消息数量; send_message_user_cnt_1d    发送消息人数;
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
        return 'dingtalk.oapi.enterprise.subarea.totaldata.stat';
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
        RequestCheckUtil::checkMaxListSize($this->returnFields, 50, 'returnFields');
        RequestCheckUtil::checkNotNull($this->statDate, 'statDate');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
