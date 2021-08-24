<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/8/23 0023
 * Time: 16:25
 */

namespace SyAliPay;

use SyTrait\SimpleTrait;

/**
 * Class AopEncrypt
 *
 * @package SyAliPay
 */
class AopEncrypt
{
    use SimpleTrait;

    /**
     * 加密方法
     *
     * @param $secretKey
     *
     * @return string
     */
    public static function encrypt(string $str, $secretKey)
    {
        //AES, 128 模式加密数据 CBC
        $secretKey = base64_decode($secretKey);
        $str = trim($str);
        $str = self::addPKCS7Padding($str);

        //设置全0的IV

        $iv = str_repeat("\0", 16);
        $encrypt_str = openssl_encrypt($str, 'aes-128-cbc', $secretKey, OPENSSL_NO_PADDING, $iv);

        return base64_encode($encrypt_str);
    }

    /**
     * 解密方法
     *
     * @param $secretKey
     *
     * @return string
     */
    public static function decrypt(string $str, $secretKey)
    {
        //AES, 128 模式加密数据 CBC
        $str = base64_decode($str);
        $secretKey = base64_decode($secretKey);

        //设置全0的IV
        $iv = str_repeat("\0", 16);
        $decrypt_str = openssl_decrypt($str, 'aes-128-cbc', $secretKey, OPENSSL_NO_PADDING, $iv);

        return self::stripPKSC7Padding($decrypt_str);
    }

    /**
     * 填充算法
     *
     * @return string
     */
    private static function addPKCS7Padding(string $source)
    {
        $source = trim($source);
        $block = 16;

        $pad = $block - (\strlen($source) % $block);
        if ($pad <= $block) {
            $char = \chr($pad);
            $source .= str_repeat($char, $pad);
        }

        return $source;
    }

    /**
     * 移去填充算法
     *
     * @return string
     */
    private static function stripPKSC7Padding(string $source)
    {
        $char = substr($source, -1);
        $num = \ord($char);
        if (62 == $num) {
            return $source;
        }

        return substr($source, 0, -$num);
    }
}
