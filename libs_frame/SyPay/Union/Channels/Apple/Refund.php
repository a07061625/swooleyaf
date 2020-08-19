<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 8:59
 */
namespace SyPay\Union\Channels\Apple;

use SyPay\Union\Channels\BaseApple;

/**
 * 退货接口
 * 对于跨清算日或者当清算日的消费交易,商户可以通过调用SDK向银联全渠道支付平台发起退货交易,从而实现客户的退款需求,支持部分退货、多次退货
 * 该交易参加资金清算,为后台交易
 *
 * @package SyPay\Union\Channels\Apple
 */
class Refund extends BaseApple
{
    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
    }

    public function __clone()
    {
    }

    public function getDetail() : array
    {
        // TODO: Implement getDetail() method.
    }
}
