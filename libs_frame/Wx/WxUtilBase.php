<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 8:55
 */

namespace Wx;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;

abstract class WxUtilBase
{
    const PLAT_TYPE_SHOP = 'shop'; //平台类型-公众号
    const PLAT_TYPE_MINI = 'mini'; //平台类型-小程序
    const PLAT_TYPE_OPEN_SHOP = 'openshop'; //平台类型-第三方平台代理公众号
    const PLAT_TYPE_OPEN_MINI = 'openmini'; //平台类型-第三方平台代理小程序
    public static $totalPlatTypes = [
        self::PLAT_TYPE_SHOP => 1,
        self::PLAT_TYPE_MINI => 1,
        self::PLAT_TYPE_OPEN_SHOP => 1,
        self::PLAT_TYPE_OPEN_MINI => 1,
    ];
    public static $errorsShortUrl = [
        'XML_FORMAT_ERROR' => 'XML格式错误',
        'POST_DATA_EMPTY' => 'post数据为空',
        'LACK_PARAMS' => '缺少参数',
        'APPID_NOT_EXIST' => 'APPID不存在',
        'MCHID_NOT_EXIST' => 'MCHID不存在',
        'APPID_MCHID_NOT_MATCH' => 'appid和mch_id不匹配',
        'REQUIRE_POST_METHOD' => '请使用post方法',
        'SIGNERROR' => '签名错误',
    ];

    /**
     * 发送post请求
     *
     * @return array|mixed
     *
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Wx\WxException
     */
    public static function sendPostReq(array $curlConfig, int $returnType = 1)
    {
        $curlConfig[CURLOPT_POST] = true;
        $curlConfig[CURLOPT_RETURNTRANSFER] = true;
        if (!isset($curlConfig[CURLOPT_TIMEOUT_MS])) {
            $curlConfig[CURLOPT_TIMEOUT_MS] = 2000;
        }
        if (!isset($curlConfig[CURLOPT_HEADER])) {
            $curlConfig[CURLOPT_HEADER] = false;
        }
        if (!isset($curlConfig[CURLOPT_SSL_VERIFYPEER])) {
            $curlConfig[CURLOPT_SSL_VERIFYPEER] = true;
        }
        if (!isset($curlConfig[CURLOPT_SSL_VERIFYHOST])) {
            $curlConfig[CURLOPT_SSL_VERIFYHOST] = 2;
        }

        return self::sendCurlReq($curlConfig, $returnType);
    }

    /**
     * 发送get请求
     *
     * @return array|mixed
     *
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Wx\WxException
     */
    public static function sendGetReq(array $curlConfig, int $returnType = 1)
    {
        $curlConfig[CURLOPT_SSL_VERIFYPEER] = false;
        $curlConfig[CURLOPT_SSL_VERIFYHOST] = false;
        $curlConfig[CURLOPT_HEADER] = false;
        $curlConfig[CURLOPT_RETURNTRANSFER] = true;
        if (!isset($curlConfig[CURLOPT_TIMEOUT_MS])) {
            $curlConfig[CURLOPT_TIMEOUT_MS] = 2000;
        }

        return self::sendCurlReq($curlConfig, $returnType);
    }

    /**
     * 用SHA1算法生成安全签名
     *
     * @param string $token      票据
     * @param string $timestamp  时间戳
     * @param string $nonce      随机字符串
     * @param string $encryptMsg 密文消息
     */
    protected static function getSha1Val(string $token, string $timestamp, string $nonce, string $encryptMsg): string
    {
        $saveArr = [$token, $timestamp, $nonce, $encryptMsg];
        sort($saveArr, SORT_STRING);
        $needStr = implode('', $saveArr);

        return sha1($needStr);
    }

    /**
     * 发送curl请求
     *
     * @return array|mixed
     *
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Wx\WxException
     */
    private static function sendCurlReq(array $curlConfig, int $returnType)
    {
        if (1 == $returnType) {
            $sendRes = Tool::sendCurlReq($curlConfig);
            if (0 == $sendRes['res_no']) {
                return $sendRes['res_content'];
            }
        } else {
            $sendRes = Tool::sendCurlReq($curlConfig, Tool::CURL_RSP_HEAD_TYPE_HTTP);
            if (0 == $sendRes['res_no']) {
                return $sendRes;
            }
        }

        if (\array_key_exists(CURLOPT_POST, $curlConfig)) {
            $errCode = ErrorCode::WX_POST_ERROR;
        } else {
            $errCode = ErrorCode::WX_GET_ERROR;
        }

        throw new WxException('curl出错，错误码=' . $sendRes['res_no'], $errCode);
    }
}
