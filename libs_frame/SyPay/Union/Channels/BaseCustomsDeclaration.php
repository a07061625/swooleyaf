<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/12 0012
 * Time: 23:49
 */
namespace SyPay\Union\Channels;

use SyPay\BaseUnionChannels;

/**
 * Class BaseCustomsDeclaration
 *
 * @package SyPay\Union\Channels
 */
abstract class BaseCustomsDeclaration extends BaseUnionChannels
{
    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
    }
}
