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
 * 预授权完成撤销接口
 * 对原始预授权完成交易的全额撤销,预授权完成撤销后的预授权仍然有效
 *
 * @package SyPay\Union\Channels\NoJump
 */
class PreAuthCompleteCancel extends BaseNoJump
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
