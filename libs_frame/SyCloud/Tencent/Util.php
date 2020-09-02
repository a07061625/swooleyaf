<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/2 0002
 * Time: 10:39
 */
namespace SyCloud\Tencent;

use SyTool\Tool;
use SyTrait\SimpleTrait;

/**
 * Class Util
 *
 * @package SyCloud\Tencent
 */
abstract class Util
{
    use SimpleTrait;

    /**
     * 生成TC3签名
     *
     * @param string $secretId
     * @param string $secretKey
     * @param array  $data
     *
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

    /**
     * 发送服务请求
     *
     * @param \SyCloud\Tencent\Base $tcBase
     * @param int                   $errCode
     *
     * @return array
     *
     * @throws \SyException\Common\CheckException
     */
    public static function sendServiceRequest(Base $tcBase, int $errCode)
    {
        $resArr = [
            'code' => 0
        ];

        $curlConfigs = $tcBase->getDetail();
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = $errCode;
            $resArr['msg'] = $sendRes['res_msg'];

            return $resArr;
        }

        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($rspData['Response']['Error'])) {
            $resArr['code'] = $errCode;
            $resArr['msg'] = $rspData['Response']['Error']['Message'];
        } elseif (isset($rspData['Response'])) {
            $resArr['data'] = $rspData['Response'];
        } else {
            $resArr['code'] = $errCode;
            $resArr['msg'] = '解析响应数据出错';
        }

        return $resArr;
    }
}
