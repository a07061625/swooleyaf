<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 22:39
 */
namespace SyPay\Union\Channels\Wap;

use SyPay\Union\Channels\BaseWap;

/**
 * 消费接口
 * 境内外持卡人在境内外商户网站进行购物等消费时用银行卡结算的交易,经批准的消费额将即时地反映到该持卡人的账户余额上
 *
 * @package SyPay\Union\Channels\Wap
 */
class Consume extends BaseWap
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
