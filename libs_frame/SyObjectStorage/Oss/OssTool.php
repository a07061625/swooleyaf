<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/19 0019
 * Time: 11:14
 */
namespace SyObjectStorage\Oss;

use DesignPatterns\Singletons\ObjectStorageConfigSingleton;
use SyTrait\SimpleTrait;

class OssTool
{
    use SimpleTrait;

    /**
     * 签名前端配置
     *
     * @param string $accessKey
     * @param array  $policy
     *
     * @return array
     *
     * @throws \SyException\Cloud\AliException
     * @throws \SyException\ObjectStorage\OssException
     */
    public static function signFrontPolicy(string $accessKey, array $policy) : array
    {
        $config = ObjectStorageConfigSingleton::getInstance()->getOssConfig($accessKey);
        $policySign = base64_encode(json_encode($policy));
        $signature = base64_encode(hash_hmac('sha1', $policySign, $config->getAccessSecret(), true));

        return [
            'policy_sign' => $policySign,
            'signature' => $signature,
        ];
    }
}
