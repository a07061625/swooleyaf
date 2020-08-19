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
 * 预授权撤销接口
 * 对已成功的POS预授权交易,在结算前使用预授权撤销交易,通知发卡方取消付款承诺
 * 预授权撤销交易必须是对原始预授权交易或追加预授权交易最终承兑金额的全额撤销
 * @package SyPay\Union\Channels\NoJump
 */
class PreAuthCancel extends BaseNoJump
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
