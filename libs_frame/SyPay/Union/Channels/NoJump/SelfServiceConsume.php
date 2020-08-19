<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 17:37
 */
namespace SyPay\Union\Channels\NoJump;

use SyPay\Union\Channels\BaseNoJump;

/**
 * 自助消费接口
 * 消费交易和开通交易两者合一,发往前台交易地址
 * @package SyPay\Union\Channels\NoJump
 */
class SelfServiceConsume extends BaseNoJump
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
