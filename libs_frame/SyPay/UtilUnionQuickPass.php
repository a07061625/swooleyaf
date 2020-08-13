<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 10:34
 */
namespace SyPay;

use DesignPatterns\Singletons\PayConfigSingleton;
use SyTool\Tool;
use SyTrait\SimpleTrait;

/**
 * Class UtilUnionQuickPass
 *
 * @package SyPay
 */
final class UtilUnionQuickPass extends UtilUnion
{
    use SimpleTrait;

    /**
     * 生成签名
     *
     * @param string $appId 应用ID
     *
     * @return string
     *
     * @throws \SyException\Pay\UnionException
     */
    public static function createSign(string $appId) : string
    {
        $config = PayConfigSingleton::getInstance()->getUnionQuickPassConfig($appId);
        $signStr = self::getSignStr([
            'appId' => $config->getAppId(),
            'secret' => $config->getAppSecret(),
            'nonceStr' => Tool::createNonceStr(8),
            'timestamp' => Tool::getNowTime(),
        ]);

        return hash('sha256', $signStr);
    }
}
