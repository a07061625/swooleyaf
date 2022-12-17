<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 机票列表
 *
 * @author auto create
 */
class OpenFlightOrderRs
{
    /**
     * 商旅申请单id
     */
    public $apply_id;

    /**
     * 到达机场
     */
    public $arr_airport;

    /**
     * 到达城市
     */
    public $arr_city;

    /**
     * 申请单名称
     */
    public $btrip_title;

    /**
     * 舱位类型
     */
    public $cabin_class;

    /**
     * 联系人
     */
    public $contact_name;

    /**
     * 企业名称
     */
    public $corp_name;

    /**
     * 企业id
     */
    public $corpid;

    /**
     * 成本中心对象
     */
    public $cost_center;

    /**
     * 出发机场
     */
    public $dep_airport;

    /**
     * 出发城市
     */
    public $dep_city;

    /**
     * 出发日期
     */
    public $dep_date;

    /**
     * 部门名称
     */
    public $dept_name;

    /**
     * 部门id
     */
    public $deptid;

    /**
     * 折扣
     */
    public $discount;

    /**
     * 航班号
     */
    public $flight_no;

    /**
     * 创建时间
     */
    public $gmt_create;

    /**
     * 更新时间
     */
    public $gmt_modified;

    /**
     * 机票订单id
     */
    public $id;

    /**
     * 保险信息
     */
    public $insure_info_list;

    /**
     * 发票信息对象
     */
    public $invoice;

    /**
     * 乘机人数量
     */
    public $passenger_count;

    /**
     * 乘机人，多个用‘,’分割
     */
    public $passenger_name;

    /**
     * 价目信息
     */
    public $price_info_list;

    /**
     * 项目code
     */
    public $project_code;

    /**
     * 项目id
     */
    public $project_id;

    /**
     * 项目名称
     */
    public $project_title;

    /**
     * 到达日期
     */
    public $ret_date;

    /**
     * 订单状态：0待支付,1出票中,2已关闭,3有改签单,4有退票单,5出票成功,6退票申请中,7改签申请中
     */
    public $status;

    /**
     * 第三方项目id
     */
    public $third_part_project_id;

    /**
     * 第三方申请单ID
     */
    public $thirdpart_apply_id;

    /**
     * 第三方行程id
     */
    public $thirdpart_itinerary_id;

    /**
     * 行程类型。0:单程，1:往返，2:中转
     */
    public $trip_type;

    /**
     * 出行人列表
     */
    public $user_affiliate_list;

    /**
     * 用户名称
     */
    public $user_name;

    /**
     * 用户id
     */
    public $userid;
}
