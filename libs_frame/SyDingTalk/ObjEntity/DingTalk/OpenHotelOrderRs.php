<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 酒店订单列表
 *
 * @author auto create
 */
class OpenHotelOrderRs
{
    /**
     * 商旅申请单id
     */
    public $apply_id;

    /**
     * 申请单名称
     */
    public $btrip_title;

    /**
     * 入住时间
     */
    public $check_in;

    /**
     * 离店时间
     */
    public $check_out;

    /**
     * 酒店所在城市
     */
    public $city;

    /**
     * 联系人姓名
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
     * 入住顾客，多个用','分割
     */
    public $guest;

    /**
     * 酒店名称
     */
    public $hotel_name;

    /**
     * 酒店开票支持类型：11 仅支持增值税普通发票 12 支持增值税专用发票和增值税普通发票
     */
    public $hotel_support_vat_invoice_type;

    /**
     * 订单id
     */
    public $id;

    /**
     * 发票对象
     */
    public $invoice;

    /**
     * 总共住几晚
     */
    public $night;

    /**
     * 订单状态
     */
    public $order_status;

    /**
     * 订单状态描述
     */
    public $order_status_desc;

    /**
     * 订单类型
     */
    public $order_type;

    /**
     * 订单类型描述
     */
    public $order_type_desc;

    /**
     * 价目详情列表
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
     * 房间数
     */
    public $room_num;

    /**
     * 房型
     */
    public $room_type;

    /**
     * 第三方项目id
     */
    public $thirdpart_project_id;

    /**
     * 第三方申请单ID
     */
    public $thirdpart_apply_id;

    /**
     * 第三方行程id
     */
    public $thirdpart_itinerary_id;

    /**
     * 入住人列表
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
