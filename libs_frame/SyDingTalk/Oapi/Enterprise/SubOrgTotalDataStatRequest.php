<?php

namespace SyDingTalk\Oapi\Enterprise;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.enterprise.suborg.totaldata.stat request
 *
 * @author auto create
 *
 * @since 1.0, 2019.08.27
 */
class SubOrgTotalDataStatRequest extends BaseRequest
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
     * act_ratio_1d_001    最近1天活跃率； act_ratio_1w_001    最近7天活跃率； act_usr_cnt_1d_001    活跃用户数最近1天； act_usr_cnt_1w_001    最近7天活跃用户数； active_mbr_cnt_std_001    历史截至当日激活会员数； active_ratio    激活率； ding_index_1d    最近1天钉钉指数； ding_index_1w    最近7天钉钉指数； mbr_cnt_std_063    历史截至当日企业会员数    ； micro_app_use_ratio_1d    最近1天使用钉钉微应用用户比率；micro_app_use_ratio_1w    最近7天使用钉钉微应用用户比率；micro_app_user_cnt_1d    最近1天使用钉钉微应用用户数；micro_app_user_cnt_1w    最近7天使用钉钉微应用用户数；pm_form_cnt_001    审批模板数； pm_form_cnt_002    自定义模板数； pm_form_self_def_ratio    自定义模板比率； process_user_cnt_1d    最近1天使用审批用户数； process_user_cnt_1w    最近7天使用审批用户数；process_user_ratio_1d    最近1天使用审批的用户比率；process_user_ratio_1w    最近7天使用审批的用户比率；send_message_user_cnt_1d    最近1天沟通用户数；send_message_user_cnt_1w    最近7天沟通用户数；send_message_user_ratio_1d    最近1天沟通率； send_message_user_ratio_1w    最近7天沟通率； sub_org_area_lat    所辖组织的地理纬度    ； sub_org_area_lng    所辖组织的地理经度    ； sub_org_name    所辖组织名称；
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
        return 'dingtalk.oapi.enterprise.suborg.totaldata.stat';
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
