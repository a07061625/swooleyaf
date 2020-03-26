<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/30 0030
 * Time: 16:03
 */
namespace SyMessagePush;

use SyConstant\ErrorCode;
use SyTool\Tool;
use SyTrait\SimpleTrait;

final class PushUtilXinGe extends PushUtilBase
{
    use SimpleTrait;

    public static function sendServiceRequest(PushBaseXinGe $pushBase)
    {
        $resArr = [
            'code' => 0,
        ];

        $sendRes = self::sendCurl($pushBase->getDetail());
        if ($sendRes === false) {
            $resArr['code'] = ErrorCode::MESSAGE_PUSH_REQ_XINGE_ERROR;
            $resArr['message'] = '发送请求出错';
        }

        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['ret_code']) && ($sendData['ret_code'] == 0)) {
            $resArr['data'] = $sendData;
        } elseif (isset($sendData['err_msg'])) {
            $resArr['code'] = ErrorCode::MESSAGE_PUSH_REQ_XINGE_ERROR;
            $resArr['message'] = $sendData['err_msg'];
        } else {
            $resArr['code'] = ErrorCode::MESSAGE_PUSH_REQ_XINGE_ERROR;
            $resArr['message'] = '解析响应数据出错';
        }

        return $resArr;
    }
}
