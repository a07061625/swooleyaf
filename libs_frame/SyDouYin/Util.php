<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/14 0014
 * Time: 20:34
 */

namespace SyDouYin;

use SyTool\Tool;

/**
 * Class Util
 * @package SyDouYin
 */
abstract class Util
{
    /**
     * 服务域名类型-抖音
     */
    const SERVICE_HOST_TYPE_DOUYIN = 'douyin';
    /**
     * 服务域名类型-头条
     */
    const SERVICE_HOST_TYPE_TOUTIAO = 'toutiao';
    /**
     * 服务域名类型-西瓜
     */
    const SERVICE_HOST_TYPE_XIGUA = 'xigua';

    public static $totalServiceHost = [
        self::SERVICE_HOST_TYPE_DOUYIN => 'https://open.douyin.com',
        self::SERVICE_HOST_TYPE_TOUTIAO => 'https://open.snssdk.com',
        self::SERVICE_HOST_TYPE_XIGUA => 'https://open-api.ixigua.com',
    ];

    /**
     * 发送服务请求
     * @param \SyDouYin\Base $service 服务请求对象
     * @param int $errorCode 异常错误码
     * @return array 请求结果
     * @throws \SyException\Common\CheckException
     */
    public static function sendServiceRequest(Base $service, int $errorCode) : array
    {
        $resArr = [
            'code' => 0
        ];

        $curlConfigs = $service->getDetail();
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = $errorCode;
            $resArr['msg'] = $sendRes['res_msg'];
            return $resArr;
        }

        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($rspData['data']['error_code'])) {
            $rspCode = (int)$rspData['data']['error_code'];
            if ($rspCode == 0) {
                $resArr['data'] = $rspData;
            } else {
                $resArr['code'] = $errorCode;
                $resArr['msg'] = $rspData['data']['description'];
            }
        } else {
            $resArr['code'] = $errorCode;
            $resArr['msg'] = '解析服务数据出错';
        }

        return $resArr;
    }
}
