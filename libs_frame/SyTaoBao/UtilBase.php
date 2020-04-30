<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/11 0011
 * Time: 13:02
 */
namespace SyTaoBao;

use SyTool\Tool;
use SyTrait\SimpleTrait;

abstract class UtilBase
{
    use SimpleTrait;

    /**
     * 生成签名字符串
     * @param array $data 参数数组
     * @param string $appSecret 应用密钥
     * @param string $signMethod 签名算法,默认为md5,支持的算法有md5,hmac
     * @return void
     */
    public static function createSign(array &$data, string $appSecret, string $signMethod = 'md5')
    {
        unset($data['sign']);
        ksort($data);
        $needStr = '';
        foreach ($data as $key => $value) {
            $needStr .= $key . $value;
        }

        if ($signMethod == 'md5') {
            $data['sign'] = strtoupper(md5($appSecret . $needStr . $appSecret));
        } else {
            $data['sign'] = strtoupper(hash_hmac('md5', $needStr, $appSecret));
        }
    }

    /**
     * 发送服务请求
     * @param \SyTaoBao\ServiceBase $serviceBase
     * @param int $errorCode
     * @return array
     */
    public static function sendRequest(ServiceBase $serviceBase, int $errorCode)
    {
        $resArr = [
            'code' => 0
        ];

        $curlConfigs = $serviceBase->getDetail();
        $responseTag = $serviceBase->getResponseTag();
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = $errorCode;
            $resArr['msg'] = $sendRes['res_msg'];
            return $resArr;
        }

        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($rspData[$responseTag])) {
            $resArr['data'] = $rspData[$responseTag];
        } elseif (isset($rspData['error_response'])) {
            $resArr['code'] = $errorCode;
            $resArr['msg'] = $rspData['error_response']['sub_msg'] ?? $rspData['error_response']['msg'];
        } else {
            $resArr['code'] = $errorCode;
            $resArr['msg'] = '解析服务数据出错';
        }
        return $resArr;
    }
}
