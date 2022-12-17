<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * module
 *
 * @author auto create
 */
class OpenTrainOrderRs
{
    /**
     * 商旅审批单id
     */
    public $apply_id;

    /**
     * 到达城市
     */
    public $arr_city;

    /**
     * 到达站
     */
    public $arr_station;

    /**
     * 到达时间
     */
    public $arr_time;

    /**
     * 申请单名称
     */
    public $btrip_title;

    /**
     * 联系人名称
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
     * 出发城市
     */
    public $dep_city;

    /**
     * 出发站
     */
    public $dep_station;

    /**
     * 出发时间
     */
    public $dep_time;

    /**
     * 部门名称
     */
    public $dept_name;

    /**
     * 部门id
     */
    public $deptid;

    /**
     * 创建时间
     */
    public $gmt_create;

    /**
     * 更新时间
     */
    public $gmt_modified;

    /**
     * 订单id
     */
    public $id;

    /**
     * 发票对象
     */
    public $invoice;

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
     * 乘客姓名
     */
    public $rider_name;

    /**
     * 运行时长
     */
    public $run_time;

    /**
     * 座位类型
     */
    public $seat_type;

    /**
     * 订单状态：0待支付,1出票中,2已关闭,3,改签成功,4退票成功,5出票完成,6退票申请中,7改签申请中,8已出票,已发货,9出票失败,10改签失败,11退票失败
     */
    public $status;

    /**
     * 第三方项目Id
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
     * 票的数量
     */
    public $ticket_count;

    /**
     * 12306票号
     */
    public $ticket_no12306;

    /**
     * 车次
     */
    public $train_number;

    /**
     * 车次类型
     */
    public $train_type;

    /**
     * 乘车人列表
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
