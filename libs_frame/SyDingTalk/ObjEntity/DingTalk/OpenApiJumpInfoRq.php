<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求对象
 *
 * @author auto create
 */
class OpenApiJumpInfoRq
{
    /**
     * 操作类型：1：预订，2：我的订单列表，3：商旅管理后台（其他参数可不要，只需corpid，userid），4：h5商旅首页
     */
    public $action_type;

    /**
     * 企业id
     */
    public $corpid;

    /**
     * 第三方行程id（存在代表通过审批单预订，不存在代表特殊场景：普通员工是预览，特殊授权人和代订人是免审批预订场景）
     */
    public $itinerary_id;

    /**
     * 员工第一次使用用车需要手机号，与司机联系
     */
    public $phone;

    /**
     * 类目类型：1：机票，2：火车票，3：酒店，4：用车
     */
    public $type;

    /**
     * 用户id
     */
    public $userid;
}
