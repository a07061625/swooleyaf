<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求对象
 *
 * @author auto create
 */
class OpenCostCenterModifyRq
{
    /**
     * 绑定支付宝账号
     */
    public $alipay_no;

    /**
     * 企业id
     */
    public $corpid;

    /**
     * 成本中心编号
     */
    public $number;

    /**
     * 适用范围: 1全员，2部分员工
     */
    public $scope;

    /**
     * 第三方成本中心id
     */
    public $thirdpart_id;

    /**
     * 成本中心名称
     */
    public $title;
}
