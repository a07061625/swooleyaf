<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-9
 * Time: 下午12:43
 */
namespace SyMap;

use SyConstant\ErrorCode;
use SyLog\Log;
use SyTool\Tool;
use SyTrait\SimpleTrait;

abstract class MapUtilBase
{
    use SimpleTrait;

    const TYPE_BAIDU = 'baidu';
    const TYPE_TENCENT = 'tencent';

    /**
     * 发送请求
     * @param array $configs 配置数组
     * @return string|bool
     */
    protected static function sendCurl(array $configs)
    {
        $configs[CURLOPT_RETURNTRANSFER] = true;
        if (!isset($configs[CURLOPT_TIMEOUT_MS])) {
            $configs[CURLOPT_TIMEOUT_MS] = 2000;
        }
        if (!isset($configs[CURLOPT_HTTPHEADER])) {
            $configs[CURLOPT_HTTPHEADER] = [];
        }
        $sendRes = Tool::sendCurlReq($configs);
        if ($sendRes['res_no'] == 0) {
            return $sendRes['res_content'];
        } else {
            Log::error('curl发送地图请求出错,错误码=' . $sendRes['res_no'] . ',错误信息=' . $sendRes['res_msg'], ErrorCode::MAP_TENCENT_GET_ERROR);
            return false;
        }
    }
}
