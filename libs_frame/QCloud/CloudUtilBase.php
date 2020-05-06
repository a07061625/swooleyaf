<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 19:30
 */
namespace QCloud;

use SyTrait\SimpleTrait;

abstract class CloudUtilBase
{
    use SimpleTrait;

    /**
     * 生成TC3签名
     * @param string $secretId
     * @param string $secretKey
     * @param array $data
     * @return array
     */
    public static function createTC3Sign(string $secretId, string $secretKey, array $data) : array
    {
        $nowTime = time();
        $dateStr = date('Y-m-d', $nowTime);
        $signedHeaders = 'content-type;host';
        $canonicalRequest = 'POST' . PHP_EOL
                            . '/' . PHP_EOL
                            . PHP_EOL
                            . 'content-type:' . strtolower(trim($data['req_headers']['Content-Type'])) . PHP_EOL
                            . 'host:' . strtolower(trim($data['req_headers']['Host'])) . PHP_EOL . PHP_EOL
                            . $signedHeaders . PHP_EOL
                            . hash('sha256', $data['req_data']);
        $credentialScope = $dateStr . '/' . $data['service_name'] . '/tc3_request';
        $signStr = 'TC3-HMAC-SHA256' . PHP_EOL
                   . $nowTime . PHP_EOL
                   . $credentialScope . PHP_EOL
                   . hash('sha256', $canonicalRequest);
        $secretDate = hash_hmac('sha256', $dateStr, 'TC3' . $secretKey);
        $secretService = hash_hmac('sha256', $data['service_name'], $secretDate);
        $secretSign = hash_hmac('sha256', 'tc3_request', $secretService);
        $signature = hash_hmac('sha256', $signStr, $secretSign);
        $authorization = 'TC3-HMAC-SHA256 Credential=' . $secretId
                         . '/' . $credentialScope
                         . ', SignedHeaders=' . $signedHeaders
                         . ', Signature=' . $signature;
        return [
            'timestamp' => $nowTime,
            'authorization' => $authorization,
        ];
    }
}
