<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/8 0008
 * Time: 15:07
 */
namespace SySms;

use Constant\ErrorCode;
use Tool\Tool;
use Traits\SimpleTrait;

abstract class SmsUtilYun253 extends SmsUtilBase {
    use SimpleTrait;

    /**
     * 发送服务请求
     * @param \SySms\SmsBaseYun253 $yun253Base
     * @return array
     */
    public static function sendServiceRequest(SmsBaseYun253 $yun253Base){
        $resArr = [
            'code' => 0
        ];

        $sendRes = self::sendCurlReq([
            CURLOPT_URL => $yun253Base->getServiceUrl(),
            CURLOPT_NOSIGNAL => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => Tool::jsonEncode($yun253Base->getDetail(), JSON_UNESCAPED_UNICODE),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Expect:',
            ],
            CURLOPT_TIMEOUT_MS => 2000,
        ]);
        if($sendRes === false){
            $resArr['code'] = ErrorCode::SMS_POST_ERROR;
            $resArr['msg'] = '发送短信请求失败';
            return $resArr;
        }

        $sendData = Tool::jsonDecode($sendRes);
        if(isset($sendData['code']) && ($sendData['code'] == 0)){
            $resArr['data'] = $sendData;
        } else if(isset($sendData['errorMsg'])){
            $resArr['code'] = ErrorCode::SMS_POST_ERROR;
            $resArr['msg'] = $sendData['errorMsg'];
        } else {
            $resArr['code'] = ErrorCode::SMS_POST_ERROR;
            $resArr['msg'] = '解析请求数据失败';
        }

        return $resArr;
    }
}