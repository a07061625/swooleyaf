<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/26 0026
 * Time: 10:47
 */
namespace DingDing;

use Constant\ErrorCode;
use Exception\DingDing\TalkException;
use Tool\Tool;

abstract class TalkUtilBase {
    /**
     * 发送post请求
     * @param array $curlConfig
     * @return mixed
     * @throws \Exception\DingDing\TalkException
     */
    public static function sendPostReq(array $curlConfig) {
        $curlConfig[CURLOPT_POST] = true;
        $curlConfig[CURLOPT_RETURNTRANSFER] = true;
        if(!isset($curlConfig[CURLOPT_TIMEOUT_MS])){
            $curlConfig[CURLOPT_TIMEOUT_MS] = 3000;
        }
        if(!isset($curlConfig[CURLOPT_HEADER])){
            $curlConfig[CURLOPT_HEADER] = false;
        }
        $sendRes = Tool::sendCurlReq($curlConfig);
        if ($sendRes['res_no'] == 0) {
            return $sendRes['res_content'];
        } else {
            throw new TalkException('curl出错，错误码=' . $sendRes['res_no'], ErrorCode::DING_TALK_POST_ERROR);
        }
    }

    /**
     * 发送get请求
     * @param array $curlConfig
     * @return mixed
     * @throws \Exception\DingDing\TalkException
     */
    public static function sendGetReq(array $curlConfig) {
        $curlConfig[CURLOPT_SSL_VERIFYPEER] = false;
        $curlConfig[CURLOPT_SSL_VERIFYHOST] = false;
        $curlConfig[CURLOPT_HEADER] = false;
        $curlConfig[CURLOPT_RETURNTRANSFER] = true;
        if(!isset($curlConfig[CURLOPT_TIMEOUT_MS])){
            $curlConfig[CURLOPT_TIMEOUT_MS] = 2000;
        }
        $sendRes = Tool::sendCurlReq($curlConfig);
        if ($sendRes['res_no'] == 0) {
            return $sendRes['res_content'];
        } else {
            throw new TalkException('curl出错，错误码=' . $sendRes['res_no'], ErrorCode::DING_TALK_GET_ERROR);
        }
    }
}