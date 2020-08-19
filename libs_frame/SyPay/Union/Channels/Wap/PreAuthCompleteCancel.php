<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 10:13
 */
namespace SyPay\Union\Channels\Wap;

use SyPay\Union\Channels\BaseWap;

/**
 * 预授权完成撤销接口
 * 必须是对原始预授权完成交易的全额撤销,预授权完成撤销后的预授权仍然有效
 *
 * @package SyPay\Union\Channels\Wap
 */
class PreAuthCompleteCancel extends BaseWap
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
