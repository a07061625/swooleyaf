<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 11:06
 */
namespace SyMessagePush;

use Constant\ErrorCode;
use Tool\Tool;
use Traits\SimpleTrait;

class PushUtilJPush extends PushUtilBase
{
    use SimpleTrait;

    public static function sendServiceRequest(PushBaseJPush $pushBase)
    {
        $resArr = [
            'code' => 0,
        ];

        $curlConfigs = $pushBase->getDetail();
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = ErrorCode::MESSAGE_PUSH_REQ_JPUSH_ERROR;
            $resArr['msg'] = $sendRes['res_msg'];
            return $resArr;
        }
        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($rspData['error'])) {
            $resArr['code'] = ErrorCode::MESSAGE_PUSH_REQ_JPUSH_ERROR;
            $resArr['msg'] = $rspData['error']['message'];
        } elseif (is_array($rspData)) {
            $resArr['data'] = $rspData;
        } else {
            $resArr['code'] = ErrorCode::MESSAGE_PUSH_REQ_JPUSH_ERROR;
            $resArr['msg'] = '解析响应数据出错';
        }
        return $resArr;
    }
}
