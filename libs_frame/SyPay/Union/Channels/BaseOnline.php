<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/12 0012
 * Time: 23:43
 */
namespace SyPay\Union\Channels;

use SyPay\BaseUnionChannels;

/**
 * Class BaseOnline
 *
 * @package SyPay\Union\Channels
 */
abstract class BaseOnline extends BaseUnionChannels
{
    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
    }
}
