<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 10:13
 */
namespace SyPay\Union\Channels\Apple;

use SyPay\Union\Channels\BaseApple;

/**
 * 预授权完成接口
 * 对已批准的预授权交易,用预授权完成做支付结算
 *
 * @package SyPay\Union\Channels\Apple
 */
class PreAuthComplete extends BaseApple
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
