<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 行程列表
 *
 * @author auto create
 */
class OpenItineraryInfo
{
    /**
     * 到达城市
     */
    public $arr_city;

    /**
     * 到达时间
     */
    public $arr_date;

    /**
     * 成本中心
     */
    public $cost_center_name;

    /**
     * 出发城市
     */
    public $dep_city;

    /**
     * 出发时间
     */
    public $dep_date;

    /**
     * 发票抬头
     */
    public $invoice_name;

    /**
     * 行程id
     */
    public $itinerary_id;

    /**
     * 项目编号
     */
    public $project_code;

    /**
     * 项目名称
     */
    public $project_title;

    /**
     * 交通方式：0飞机 1火车 2汽车 3其他
     */
    public $traffic_type;

    /**
     * 行程方式：0单程 1往返
     */
    public $trip_way;
}
