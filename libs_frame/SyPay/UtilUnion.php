<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/12 0012
 * Time: 13:45
 */
namespace SyPay;

use DesignPatterns\Singletons\PayConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyTrait\SimpleTrait;

/**
 * Class UtilUnion
 * @package SyPay
 */
final class UtilUnion extends Util
{
    use SimpleTrait;

    /**
     * 获取待签名字符串
     * @param array $data
     * @return string
     */
    private static function getSignStr(array $data) : string
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

    /**
     * 生成签名
     * @param string $merId 商户号
     * @param array $data 待签名数据
     * @return string
     * @throws \SyException\Pay\UnionException
     */
    public static function createSign(string $merId, array $data) : string
    {
        $signStr = self::getSignStr($data);
        $sha1Str = sha1(substr($signStr, 1), false);
        $sign = '';
        $config = PayConfigSingleton::getInstance()->getUnionConfig($merId);
        if (!openssl_sign($sha1Str, $sign, $config->getCertPrivateKey(), OPENSSL_ALGO_SHA1)) {
            throw new UnionException('银联支付生成签名出错', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        return base64_encode($sign);
    }

    /**
     * 校验签名
     * @param string $merId 商户号
     * @param array $data 待校验数据
     * @return bool
     * @throws \SyException\Pay\UnionException
     */
    public static function verifySign(string $merId, array $data) : bool
    {
        $config = PayConfigSingleton::getInstance()->getUnionConfig($merId);
        if ($config->getCertPrivateId() != $data['certId']) {
            return false;
        }

        $nowSign = $data['signature'];
        $signStr = self::getSignStr($data);
        $sha1Str = sha1($signStr, false);
        $verifyRes = openssl_verify($sha1Str, base64_decode($nowSign), $config->getCertPublicKey(), OPENSSL_ALGO_SHA1);
        return $verifyRes == 1;
    }
}
