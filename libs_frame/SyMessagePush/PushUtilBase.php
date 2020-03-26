<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/30 0030
 * Time: 16:02
 */
namespace SyMessagePush;

use SyConstant\ErrorCode;
use SyLog\Log;
use SyTool\Tool;
use SyTrait\SimpleTrait;

abstract class PushUtilBase
{
    use SimpleTrait;

    /**
     * 发送请求
     * @param array $configs 配置数组
     * @return string|bool
     */
    protected static function sendCurl(array $configs)
    {
        $configs[CURLOPT_RETURNTRANSFER] = true;
        if (!isset($configs[CURLOPT_TIMEOUT_MS])) {
            $configs[CURLOPT_TIMEOUT_MS] = 3000;
        }
        $sendRes = Tool::sendCurlReq($configs);
        if ($sendRes['res_no'] == 0) {
            return $sendRes['res_content'];
        } else {
            Log::error('curl发送消息推送请求出错,错误码=' . $sendRes['res_no'] . ',错误信息=' . $sendRes['res_msg'], ErrorCode::MESSAGE_PUSH_POST_ERROR);
            return false;
        }
    }
}
