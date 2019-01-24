<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/19 0019
 * Time: 11:14
 */
namespace AliOss;

use DesignPatterns\Singletons\AliOssSingleton;
use Traits\SimpleTrait;

class OssTool {
    use SimpleTrait;

    /**
     * 签名前端配置
     * @param array $policy
     * @return array
     */
    public static function signFrontPolicy(array $policy) : array {
        $policySign = base64_encode(json_encode($policy));
        $signature = base64_encode(hash_hmac('sha1', $policySign, AliOssSingleton::getInstance()->getOssConfig()->getAccessKeySecret(), true));

        return [
            'policy_sign' => $policySign,
            'signature' => $signature,
        ];
    }
}