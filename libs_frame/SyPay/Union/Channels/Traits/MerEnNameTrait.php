<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/21 0021
 * Time: 10:27
 */
namespace SyPay\Union\Channels\Traits;

/**
 * Class MerEnNameTrait
 *
 * @package SyPay\Union\Channels\Traits
 */
trait MerEnNameTrait
{
    /**
     * @param string $merEnName 商户英文名称
     */
    public function setMerEnName(string $merEnName)
    {
        if (strlen($merEnName) > 0) {
            $this->reqData['merEnName'] = $merEnName;
        }
    }
}
