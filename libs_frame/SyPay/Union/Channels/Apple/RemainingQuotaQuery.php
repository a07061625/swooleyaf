<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 17:37
 */
namespace SyPay\Union\Channels\Apple;

use SyPay\Union\Channels\BaseApple;

/**
 * 营销活动余额查询接口
 * 目前Apple Pay做营销时,为避免造成用户支付时页面上显示有优惠,实际上支付没有享受到优惠
 * 通过此接口可以知道活动剩余名额,当该营销活动还有优惠时,商户APP需要自动的展示当面优惠活动,从而引导用户使用Apple Pay进行远程支付
 * 建议查询间隔时间至少1分钟
 * @package SyPay\Union\Channels\Apple
 */
class RemainingQuotaQuery extends BaseApple
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
