<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/11/21 0021
 * Time: 18:02
 */
namespace SyCloud\QiNiu;

use DesignPatterns\Singletons\ObjectStorageConfigSingleton;
use SyConstant\ErrorCode;
use SyLog\Log;
use SyTool\Tool;
use SyTrait\SimpleTrait;

abstract class Util
{
    use SimpleTrait;

    /**
     * 安全的Base64编码
     *
     * @param string $data 待编码数据
     *
     * @return string
     */
    public static function safeBase64(string $data) : string
    {
        $base64Str = base64_encode($data);

        return str_replace(['+', '/'], ['-', '_'], $base64Str);
    }

    /**
     * 生成管理凭证
     *
     * @param string $accessKey
     * @param string $uri       请求URI
     * @param string $body      请求体
     *
     * @return string
     *
     * @throws \SyException\Cloud\QiNiuException
     * @throws \SyException\ObjectStorage\KodoException
     */
    public static function createAccessToken(string $accessKey, string $uri, string $body = '') : string
    {
        $config = ObjectStorageConfigSingleton::getInstance()->getKodoConfig($accessKey);
        $data = $uri . "\n" . $body;
        $signStr = hash_hmac('sha1', $data, $config->getSecretKey());

        return $config->getAccessKey() . ':' . self::safeBase64($signStr);
    }

    /**
     * 编码URI
     *
     * @param string $bucketName 空间名称
     * @param string $fileKey    文件key
     *
     * @return string
     */
    public static function encodeUri(string $bucketName, string $fileKey)
    {
        return self::safeBase64($bucketName . ':' . $fileKey);
    }

    /**
     * @param array $configs
     *
     * @return bool|mixed
     *
     * @throws \SyException\Common\CheckException
     */
    public static function sendCurl(array $configs)
    {
        $configs[CURLOPT_HEADER] = false;
        $configs[CURLOPT_RETURNTRANSFER] = true;
        if (!isset($configs[CURLOPT_TIMEOUT_MS])) {
            $configs[CURLOPT_TIMEOUT_MS] = 2000;
        }
        $sendRes = Tool::sendCurlReq($configs);
        if ($sendRes['res_no'] == 0) {
            return $sendRes['res_content'];
        }
        $logStr = 'curl发送七牛云请求出错,错误码:' . $sendRes['res_no'] . ', 错误信息:' . $sendRes['res_msg'];
        Log::error($logStr, ErrorCode::COMMON_SERVER_ERROR);

        return false;
    }
}
