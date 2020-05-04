<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 10:56
 */
namespace Wx;

use DesignPatterns\Singletons\WxConfigSingleton;
use SyTrait\SimpleTrait;

final class WxUtilAccount extends WxUtilAlone
{
    use SimpleTrait;

    /**
     * 生成签名
     * @param array $data
     * @param string $appId
     * @param string $signType
     * @return string
     */
    public static function createSign(array $data, string $appId, string $signType = 'md5')
    {
        //签名步骤一：按字典序排序参数
        ksort($data);
        //签名步骤二：格式化后加入KEY
        $needStr1 = '';
        foreach ($data as $key => $value) {
            if ($key == 'sign') {
                continue;
            }
            if ((!is_string($value)) && !is_numeric($value)) {
                continue;
            }
            if (strlen($value) == 0) {
                continue;
            }
            $needStr1 .= $key . '=' . $value . '&';
        }

        $payKey = WxConfigSingleton::getInstance()->getAccountConfig($appId)->getPayKey();
        $needStr1 .= 'key=' . $payKey;
        //签名步骤三：加密
        if ($signType == 'md5') {
            $needStr2 = md5($needStr1);
        } else {
            $needStr2 = hash_hmac('sha256', $needStr1, $payKey);
        }
        //签名步骤四：所有字符转为大写
        return strtoupper($needStr2);
    }

    /**
     * 校验数据签名合法性
     * @param array $data 待校验数据
     * @param string $appId
     * @return bool
     */
    public static function checkSign(array $data, string $appId) : bool
    {
        if (isset($data['sign']) && is_string($data['sign'])) {
            $nowSign = self::createSign($data, $appId);
            return $nowSign === $data['sign'];
        }

        return false;
    }
}
