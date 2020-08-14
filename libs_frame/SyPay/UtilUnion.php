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
 *
 * @package SyPay
 */
class UtilUnion extends Util
{
    use SimpleTrait;

    /**
     * 获取待签名字符串
     *
     * @param array $data
     * @param bool  $isEncode
     *
     * @return string
     */
    public static function getSignStr(array $data, bool $isEncode = false) : string
    {
        ksort($data);
        $signStr = '';
        if ($isEncode) {
            foreach ($data as $key => $val) {
                if ($key == 'signature') {
                    continue;
                }
                $signStr .= '&' . $key . '=' . urlencode($val);
            }
        } else {
            foreach ($data as $key => $val) {
                if ($key == 'signature') {
                    continue;
                }
                $signStr .= '&' . $key . '=' . $val;
            }
        }

        return substr($signStr, 1);
    }
}
