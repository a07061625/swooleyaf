<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/13 0013
 * Time: 16:49
 */

namespace SyPromotion\TBK\Traits;

/**
 * Trait SetDeviceEncryptTrait
 *
 * @package SyPromotion\TBK\Traits
 */
trait SetDeviceEncryptTrait
{
    public function setDeviceEncrypt(string $deviceEncrypt)
    {
        if (\strlen($deviceEncrypt) > 0) {
            $this->reqData['device_encrypt'] = $deviceEncrypt;
        } else {
            unset($this->reqData['device_encrypt']);
        }
    }
}
