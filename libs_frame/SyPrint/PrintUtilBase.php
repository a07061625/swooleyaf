<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/10 0010
 * Time: 18:05
 */
namespace SyPrint;

use SyConstant\ErrorCode;
use SyException\SyPrint\FeYinException;
use SyTool\Tool;
use SyTrait\SimpleTrait;

abstract class PrintUtilBase
{
    use SimpleTrait;

    /**
     * 发送post请求
     * @param array $curlConfig
     * @return mixed
     * @throws \SyException\SyPrint\FeYinException
     */
    public static function sendPostReq(array $curlConfig)
    {
        $curlConfig[CURLOPT_POST] = true;
        $curlConfig[CURLOPT_RETURNTRANSFER] = true;
        if (!isset($curlConfig[CURLOPT_TIMEOUT_MS])) {
            $curlConfig[CURLOPT_TIMEOUT_MS] = 3000;
        }
        if (!isset($curlConfig[CURLOPT_HEADER])) {
            $curlConfig[CURLOPT_HEADER] = false;
        }
        $sendRes = Tool::sendCurlReq($curlConfig);
        if ($sendRes['res_no'] == 0) {
            return $sendRes['res_content'];
        } else {
            throw new FeYinException('curl出错，错误码=' . $sendRes['res_no'], ErrorCode::PRINT_POST_ERROR);
        }
    }

    /**
     * 发送get请求
     * @param array $curlConfig
     * @return mixed
     * @throws \SyException\SyPrint\FeYinException
     */
    public static function sendGetReq(array $curlConfig)
    {
        $curlConfig[CURLOPT_SSL_VERIFYPEER] = false;
        $curlConfig[CURLOPT_SSL_VERIFYHOST] = false;
        $curlConfig[CURLOPT_HEADER] = false;
        $curlConfig[CURLOPT_RETURNTRANSFER] = true;
        if (!isset($curlConfig[CURLOPT_TIMEOUT_MS])) {
            $curlConfig[CURLOPT_TIMEOUT_MS] = 2000;
        }
        $sendRes = Tool::sendCurlReq($curlConfig);
        if ($sendRes['res_no'] == 0) {
            return $sendRes['res_content'];
        } else {
            throw new FeYinException('curl出错，错误码=' . $sendRes['res_no'], ErrorCode::PRINT_GET_ERROR);
        }
    }
}
