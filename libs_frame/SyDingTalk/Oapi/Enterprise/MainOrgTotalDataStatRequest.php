<?php

namespace SyDingTalk\Oapi\Enterprise;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.enterprise.mainorg.totaldata.stat request
 *
 * @author auto create
 *
 * @since 1.0, 2019.09.02
 */
class MainOrgTotalDataStatRequest extends BaseRequest
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
     * active_mbr_cnt_std    在线组织激活用户数    ； all_group_cnt    全员群数量； carbon_amount_1d    最近1天降低碳排量G； carbon_amount_1w    最近7天降低碳排量G； corp_id    企业ID； dept_group_cnt    部门群数量； ding_save_hour_1d    最近1天钉办节约小时； ding_save_hour_1w    最近7天钉办节约小时； inner_group_cnt    内部群数量； live_launch_succ_cnt_1d    最近1天成功发起直播次数；live_launch_succ_cnt_1w    最近7天成功发起直播次数； mbr_cnt_std    在线组织通讯录人数（注册人数）；online_conference_cnt_1d    最近1天在线会议次数；online_conference_cnt_7d    最近7天在线会议次数； online_org_cnt    在线组织数； org_online_ratio    组织覆盖率； real_org_cnt    实际组织数； receive_ding_user_cnt_1d    最近1天接收DING的用户数；receive_ding_user_cnt_1w    最近7天接收DING的用户数； rel_org_cnt    关联组织数 send_message_user_cnt_1d    最近1天发送消息人数；send_message_user_cnt_1w    最近7天发送消息人数； stat_date    统计日期
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
        return 'dingtalk.oapi.enterprise.mainorg.totaldata.stat';
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
