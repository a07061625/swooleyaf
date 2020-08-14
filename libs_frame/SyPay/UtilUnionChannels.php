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
 * Class UtilUnionChannels
 *
 * @package SyPay
 */
final class UtilUnionChannels extends UtilUnion
{
    use SimpleTrait;

    /**
     * 生成签名
     *
     * @param string $merId 商户号
     * @param array  $data  待签名数据
     *
     * @throws \SyException\Pay\UnionException
     */
    public static function createSign(string $merId, array &$data)
    {
        $signStr = self::getSignStr($data);
        $sha1Str = sha1(substr($signStr, 1), false);
        $sign = '';
        $config = PayConfigSingleton::getInstance()->getUnionChannelsConfig($merId);
        if (!openssl_sign($sha1Str, $sign, $config->getCertPrivateKey(), OPENSSL_ALGO_SHA1)) {
            throw new UnionException('银联支付生成签名出错', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $data['signature'] = base64_encode($sign);
    }

    /**
     * 校验签名
     *
     * @param string $merId 商户号
     * @param array  $data  待校验数据
     *
     * @return bool
     *
     * @throws \SyException\Pay\UnionException
     */
    public static function verifySign(string $merId, array $data) : bool
    {
        $config = PayConfigSingleton::getInstance()->getUnionChannelsConfig($merId);
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
