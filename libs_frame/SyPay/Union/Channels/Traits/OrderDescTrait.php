<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 11:07
 */
namespace SyPay\Union\Channels\Traits;

/**
 * Class OrderDescTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait OrderDescTrait
{
    /**
     * @param string $orderDesc 订单描述
     */
    public function setOrderDesc(string $orderDesc)
    {
        if (strlen($orderDesc) > 0) {
            $this->reqData['orderDesc'] = $orderDesc;
        }
    }
}
