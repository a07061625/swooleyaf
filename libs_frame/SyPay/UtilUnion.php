<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 10:10
 */
namespace SyPay;

use SyTrait\SimpleTrait;

/**
 * Class UtilUnion
 * @package SyPay
 */
class UtilUnion extends Util
{
    use SimpleTrait;

    /**
     * 获取待签名字符串
     *
     * @param array $data
     *
     * @return string
     */
    protected static function getSignStr(array $data) : string
    {
        ksort($data);
        $signStr = '';
        foreach ($data as $key => $val) {
            if ($key == 'signature') {
                continue;
            }
            $signStr .= '&' . $key . '=' . $val;
        }

        return substr($signStr, 1);
    }
}
