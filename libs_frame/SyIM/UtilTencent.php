<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/7/17 0017
 * Time: 8:42
 */

namespace SyIM;

use DesignPatterns\Singletons\IMConfigSingleton;
use ProjectCache\IMAccount;
use SyConstant\ErrorCode;
use SyException\IM\TencentException;
use SyLog\Log;
use SyTool\Tool;
use SyTrait\SimpleTrait;

/**
 * Class UtilTencent
 *
 * @package SyIM
 */
class UtilTencent
{
    use SimpleTrait;

    const RESP_SUCCESS = 'OK';

    /**
     * 生成签名
     *
     * @param string $appId   应用ID
     * @param string $userTag 用户标识
     *
     * @throws \SyException\IM\TencentException
     */
    public static function createSign(string $appId, string $userTag): string
    {
        $output = [];
        $commandStatus = 0;
        $config = IMConfigSingleton::getInstance()->getTencentConfig($appId);
        $command = $config->getCommandSign()
                   . ' ' . escapeshellarg($config->getPrivateKey())
                   . ' ' . escapeshellarg($config->getAppId())
                   . ' ' . escapeshellarg($userTag);
        exec($command, $output, $commandStatus);
        if (-1 == $commandStatus) {
            throw new TencentException('生成即时通讯签名失败', ErrorCode::IM_SIGN_ERROR);
        }

        return $output[0];
    }

    /**
     * 发生服务请求
     *
     * @param string $appId       应用ID
     * @param string $uri         请求URI,以/开头
     * @param array  $data        请求数据,具体格式请参考官方文档 https://cloud.tencent.com/document/product/269/1519
     * @param string $successKey  响应成功获取的数据键名
     * @param array  $curlConfigs curl配置
     *
     * @return array 请求结果
     *
     * @throws \Exception
     */
    public static function sendServiceRequest(
        string $appId,
        string $uri,
        array $data,
        string $successKey = '',
        array $curlConfigs = []
    ): array {
        $resArr = [
            'code' => 0,
        ];

        $config = IMConfigSingleton::getInstance()->getTencentConfig($appId);
        $url = 'https://console.tim.qq.com' . $uri . '?' . http_build_query([
            'contenttype' => 'json',
            'random' => random_int(10000000, 99999999),
            'sdkappid' => $config->getAppId(),
            'identifier' => $config->getAccountAdmin(),
            'usersig' => IMAccount::getAccountSign($appId, $config->getAccountAdmin()),
        ]);
        $curlConfigs[CURLOPT_URL] = $url;
        $curlConfigs[CURLOPT_POST] = true;
        $curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($data, JSON_UNESCAPED_UNICODE);
        $curlConfigs[CURLOPT_RETURNTRANSFER] = true;
        $curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        if (!isset($curlConfigs[CURLOPT_TIMEOUT_MS])) {
            $curlConfigs[CURLOPT_TIMEOUT_MS] = 2000;
        }
        if (!isset($curlConfigs[CURLOPT_HEADER])) {
            $curlConfigs[CURLOPT_HEADER] = false;
        }
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            Log::error('发送腾讯IM请求失败,错误码=' . $sendRes['res_no']);
            $resArr['code'] = ErrorCode::IM_POST_ERROR;
            $resArr['msg'] = '发送腾讯IM请求失败';

            return $resArr;
        }
        $sendData = Tool::jsonDecode($sendRes['res_no']);
        if (self::RESP_SUCCESS == $sendData['ActionStatus']) {
            unset($sendData['ActionStatus'], $sendData['ErrorCode'], $sendData['ErrorInfo']);
            if ((\strlen($successKey) > 0) && isset($sendData[$successKey])) {
                $resArr['data'] = $sendData[$successKey];
            } else {
                $resArr['data'] = $sendData;
            }
        } else {
            $resArr['code'] = ErrorCode::IM_POST_ERROR;
            $resArr['im_code'] = $sendData['ErrorCode'];
            $resArr['msg'] = $sendData['ErrorInfo'];
        }

        return $resArr;
    }
}
