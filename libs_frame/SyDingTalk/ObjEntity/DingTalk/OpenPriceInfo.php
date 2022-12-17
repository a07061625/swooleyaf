<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 价目详情列表
 *
 * @author auto create
 */
class OpenPriceInfo
{
    /**
     * 交易类型：用车支付, 服务费, 用车取消后收费, 用车退款, 用车赔付
     */
    public $category;

    /**
     * 交易类目编码
     */
    public $category_code;

    /**
     * 交易类目类型1-飞机，2-酒店，3-火车，4-用车
     */
    public $category_type;

    /**
     * 流水创建时间
     */
    public $gmt_create;

    /**
     * 出行人，多个用‘,’分割
     */
    public $passenger_name;

    /**
     * 结算方式:1：个人现付，2:企业现付,4:企业月结，8、企业预存
     */
    public $pay_type;

    /**
     * 价格
     */
    public $price;

    /**
     * 交易流水ID
     */
    public $trade_id;

    /**
     * 资金流向:1:支出，2:收入
     */
    public $type;
}
