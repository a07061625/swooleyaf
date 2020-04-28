<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/4/21 0021
 * Time: 14:04
 */
namespace SyCredit;

use DesignPatterns\Singletons\CreditConfigSingleton;
use SyTrait\SimpleTrait;

/**
 * Class UtilMaiLe
 * @package SyCredit
 */
abstract class UtilMaiLe extends UtilCommon
{
    use SimpleTrait;

    /**
     * 生成签名
     * @param array $data
     */
    public static function createSign(array &$data)
    {
        unset($data['sign']);
        ksort($data);
        $signStr = '';
        foreach ($data as $k => $v) {
            $signStr .= $v;
        }
        $signStr .= CreditConfigSingleton::getInstance()->getMaiLeConfig()->getAppSecret();
        $data['sign'] = md5($signStr);
    }

    /**
     * 检验签名
     * @param array $data
     * @return bool
     */
    public static function checkSign(array $data) : bool
    {
        $existSign = $data['sign'] ?? '';
        if(is_string($existSign) && (strlen($existSign) > 0)){
            self::createSign($data);
            return $existSign == $data['sign'];
        }

        return false;
    }
}
