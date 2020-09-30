<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/11/21 0021
 * Time: 18:03
 */
namespace SyObjectStorage;

use DesignPatterns\Singletons\ObjectStorageConfigSingleton;
use SyCloud\QiNiu\Util;
use SyConstant\ErrorCode;
use SyTool\Tool;
use SyTrait\SimpleTrait;

final class UtilKodo extends Util
{
    use SimpleTrait;

    /**
     * 发送服务请求
     *
     * @param \SyObjectStorage\BaseKodo $baseService
     *
     * @return array
     *
     * @throws \SyException\Common\CheckException
     */
    public static function sendServiceRequest(BaseKodo $baseService)
    {
        $resArr = [
            'code' => 0,
        ];

        $sendRes = self::sendCurl($baseService->getDetail());
        if ($sendRes === false) {
            $resArr['code'] = ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR;
            $resArr['message'] = '发送请求出错';
        }

        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['error'])) {
            $resArr['code'] = ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR;
            $resArr['message'] = $sendData['error'];
        } elseif (is_array($sendData)) {
            $resArr['data'] = $sendData;
        } elseif (strlen($sendRes) == 0) {
            $resArr['data'] = [
                'result' => 'success',
            ];
        } else {
            $resArr['code'] = ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR;
            $resArr['message'] = '解析响应数据出错';
        }

        return $resArr;
    }

    /**
     * 链接添加下载凭证
     *
     * @param string $accessKey
     * @param string $url        链接地址
     * @param int    $expireTime 超时时间,单位为秒
     *
     * @return bool
     *
     * @throws \SyException\Cloud\QiNiuException
     * @throws \SyException\ObjectStorage\KodoException
     */
    public static function addDownloadToken(string $accessKey, string &$url, int $expireTime)
    {
        if ($expireTime <= 0) {
            return false;
        }

        $urlArr = explode('?', $url);
        if (isset($urlArr[1]) && (strlen($urlArr[1]) > 0)) {
            $queryArr = parse_str($urlArr[1]);
        } else {
            $queryArr = [];
        }
        $queryArr['e'] = time() + $expireTime;
        unset($queryArr['token']);
        $downloadUrl = $urlArr[0] . '?' . http_build_query($queryArr);
        $config = ObjectStorageConfigSingleton::getInstance()->getKodoConfig($accessKey);
        $sign = hash_hmac('sha1', $downloadUrl, $config->getSecretKey());
        $url = $downloadUrl . '&token=' . $config->getAccessKey() . ':' . self::safeBase64($sign);

        return true;
    }

    /**
     * 生成上传凭证
     *
     * @param string $accessKey
     * @param array  $data
     *                          字段如下:
     *                          bucket_name: string 空间名称
     *                          file_key: string 文件key
     *                          expire_time: int 到期时间戳
     *                          return_data: string 响应返回数据,json格式
     *
     * @return string
     *
     * @throws \SyException\Cloud\QiNiuException
     * @throws \SyException\ObjectStorage\KodoException
     */
    public static function createUploadToken(string $accessKey, array $data)
    {
        $config = ObjectStorageConfigSingleton::getInstance()->getKodoConfig($accessKey);
        $policyStr = Tool::jsonEncode([
            'scope' => $data['bucket_name'] . ':' . $data['file_key'],
            'deadline' => $data['expire_time'],
            'returnBody' => $data['return_data'],
        ], JSON_UNESCAPED_UNICODE);
        $encodePolicy = self::safeBase64($policyStr);
        $sign = hash_hmac('sha1', $encodePolicy, $config->getSecretKey());

        return $config->getAccessKey() . ':' . self::safeBase64($sign) . ':' . $encodePolicy;
    }
}
