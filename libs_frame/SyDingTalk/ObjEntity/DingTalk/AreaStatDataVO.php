<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 系统自动生成
 *
 * @author auto create
 */
class AreaStatDataVO
{
    /**
     * 所辖区域活跃率
     */
    public $act_ratio1d;

    /**
     * 活跃用户数最近1天
     */
    public $act_usr_cn1d;

    /**
     * 历史截至当日激活会员数
     */
    public $active_mbr_cnt_std;

    /**
     * 所辖区域用户的激活率
     */
    public $active_mbr_ratio;

    /**
     * 所属城市维度
     */
    public $city_lat;

    /**
     * 所属城市经度
     */
    public $city_lng;

    /**
     * 城市名称
     */
    public $city_name;

    /**
     * 企业ID
     */
    public $corp_id;

    /**
     * 区/县纬度
     */
    public $county_lat;

    /**
     * 区/县经度
     */
    public $county_lng;

    /**
     * 城市所在区域
     */
    public $county_name;

    /**
     * 历史截至当日企业会员数
     */
    public $mbr_cnt_std;

    /**
     * 所辖区域在线组织数
     */
    public $online_org_cnt;

    /**
     * 所辖区域组织覆盖率
     */
    public $org_online_ratio;

    /**
     * 所辖区域实际组织数
     */
    public $real_org_cnt;

    /**
     * 发送消息数量
     */
    public $send_message_cnt1d;

    /**
     * 发送消息人数
     */
    public $send_message_user_cnt1d;

    /**
     * 查询时间
     */
    public $stat_date;
}
