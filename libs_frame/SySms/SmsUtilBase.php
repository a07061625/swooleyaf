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

abstract class SmsUtilBase {
    use SimpleTrait;

    /**
     * 发送请求
     * @param string $url 请求地址
     * @param array $data 请求参数
     * @param array $curlConfig curl配置数组
     * @return mixed
     */
    protected static function sendCurlReq(array $curlConfig){
        $sendRes = Tool::sendCurlReq($curlConfig);
        if($sendRes['res_no'] > 0){
            Log::error('短信请求失败,curl错误码为' . $sendRes['res_no'], ErrorCode::SMS_POST_ERROR);
        }

        return $sendRes['res_content'];
    }
}