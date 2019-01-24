<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/7 0007
 * Time: 9:45
 */
namespace SySms;

use Constant\ErrorCode;
use Log\Log;
use Tool\Tool;
use Traits\SimpleTrait;

abstract class SmsUtilDaYu extends SmsUtilBase {
    use SimpleTrait;

    protected static $urlHttp = 'http://gw.api.taobao.com/router/rest';

    /**
     * 生成签名字符串
     * @param array $data 参数数组
     * @param string $appSecret 应用密钥
     * @return void
     */
    public static function createSign(array &$data,string $appSecret){
        unset($data['sign']);
        ksort($data);
        $needStr = $appSecret;
        foreach ($data as $key => $value) {
            $needStr .= $key . $value;
        }
        $needStr .= $appSecret;
        $data['sign'] = strtoupper(md5($needStr));
    }

    /**
     * 发送服务请求
     * @param \SySms\SmsBaseDaYu $daYuBase
     * @return array
     */
    public static function sendServiceRequest(SmsBaseDaYu $daYuBase) {
        $resArr = [
            'code' => 0
        ];

        $data = $daYuBase->getDetail();
        $responseTag = $daYuBase->getResponseTag();
        $sendRes = self::sendCurlReq([
            CURLOPT_URL => self::$urlHttp,
            CURLOPT_NOSIGNAL => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Expect:',
            ],
            CURLOPT_TIMEOUT_MS => 2000,
        ]);
        $rspData = Tool::jsonDecode($sendRes);
        if (isset($rspData[$responseTag])) {
            $resArr['data'] = $rspData[$responseTag];
        } else if(isset($rspData['error_response'])){
            $resArr['code'] = ErrorCode::SMS_POST_ERROR;
            $resArr['msg'] = $rspData['error_response']['sub_msg'];
        } else {
            Log::error($sendRes, ErrorCode::SMS_POST_ERROR);
            $resArr['code'] = ErrorCode::SMS_POST_ERROR;
            $resArr['msg'] = '解析服务数据出错';
        }

        return $resArr;
    }
}