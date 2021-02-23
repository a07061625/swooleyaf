<?php

namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class RefundBaseEntity extends MysqlEntity
{
    /**
     * @var int
     */
    public $id;

    /**
     * 退款类型
     *
     * @var int
     */
    public $type = 0;

    /**
     * 用户ID
     *
     * @var string
     */
    public $uid = '';

    /**
     * 退款对象ID
     *
     * @var string
     */
    public $object_id = '';

    /**
     * 退款对象所属者ID
     *
     * @var string
     */
    public $object_bid = '';

    /**
     * 退款对象名称
     *
     * @var string
     */
    public $object_name = '';

    /**
     * 对象单价,单位为分
     *
     * @var int
     */
    public $object_price = 0;

    /**
     * 对象总数量
     *
     * @var int
     */
    public $object_num = 0;

    /**
     * 对象退款数量
     *
     * @var int
     */
    public $object_rnum = 0;

    /**
     * 付款单号
     *
     * @var string
     */
    public $pay_sn = '';

    /**
     * 支付金额,单位为分
     *
     * @var int
     */
    public $pay_money = 0;

    /**
     * 退款单号
     *
     * @var string
     */
    public $refund_sn = '';

    /**
     * 退款金额,单位为分
     *
     * @var int
     */
    public $refund_money = 0;

    /**
     * 备注
     *
     * @var string
     */
    public $remark = '';

    /**
     * 状态
     *
     * @var int
     */
    public $status = 0;

    /**
     * 创建时间戳
     *
     * @var int
     */
    public $created = 0;

    /**
     * 修改时间戳
     *
     * @var int
     */
    public $updated = 0;

    public function __construct(string $dbTag = '')
    {
        $trueTag = isset($dbTag[0]) ? $dbTag : 'main';
        parent::__construct($trueTag, 'refund_base', 'id');
    }
}
