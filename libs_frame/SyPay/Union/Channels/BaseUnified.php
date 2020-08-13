<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/12 0012
 * Time: 23:47
 */
namespace SyPay\Union\Channels;

use SyPay\BaseUnionChannels;

/**
 * Class BaseUnified
 *
 * @package SyPay\Union\Channels
 */
abstract class BaseUnified extends BaseUnionChannels
{
    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqData['version'] = '6.0.0';
    }
}
