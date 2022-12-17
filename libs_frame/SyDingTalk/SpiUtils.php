<?php

namespace SyDingTalk;

use body;
use form;
use secret;

class SpiUtils
{
    private static $top_sign_list = 'HTTP_TOP_SIGN_LIST';
    private static $timestamp = 'timestamp';
    private static $header_real_ip = [
        'X_Real_IP',
        'X_Forwarded_For',
        'Proxy_Client_IP',
        'WL_Proxy_Client_IP',
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
    ];

    /**
     * 校验SPI请求签名，适用于所有GET请求，及不包含文件参数的POST请求。
     *
     * @param request 请求对象
     * @param secret app对应的secret
     * @param mixed $secret
     *
     * @return bool
     */
    public static function checkSign4FormRequest($secret)
    {
        return self::checkSign(null, null, $secret);
    }

    /**
     * 校验SPI请求签名，适用于请求体是xml/json等可用文本表示的POST请求。
     *
     * @param request 请求对象
     * @param body 请求体的文本内容
     * @param secret app对应的secret
     * @param mixed $body
     * @param mixed $secret
     *
     * @return bool
     */
    public static function checkSign4TextRequest($body, $secret)
    {
        return self::checkSign(null, $body, $secret);
    }

    /**
     * 校验SPI请求签名，适用于带文件上传的POST请求。
     *
     * @param request 请求对象
     * @param form 除了文件参数以外的所有普通文本参数的map集合
     * @param secret app对应的secret
     * @param mixed $form
     * @param mixed $secret
     *
     * @return bool
     */
    public static function checkSign4FileRequest($form, $secret)
    {
        return self::checkSign($form, null, $secret);
    }

    private static function checkSign($form, $body, $secret): bool
    {
        $params = [];
        // 1. 获取header参数
        $headerMap = self::getHeaderMap();
        foreach ($headerMap as $k => $v) {
            $params[$k] = $v;
        }

        // 2. 获取url参数
        $queryMap = self::getQueryMap();
        foreach ($queryMap as $k => $v) {
            $params[$k] = $v;
        }

        // 3. 获取form参数
        if (null == $form && null == $body) {
            $formMap = self::getFormMap();
            foreach ($formMap as $k => $v) {
                $params[$k] = $v;
            }
        } elseif (null != $form) {
            foreach ($form as $k => $v) {
                $params[$k] = $v;
            }
        }

        if (null == $body) {
            $body = file_get_contents('php://input');
        }

        $remoteSign = $queryMap['sign'];
        $localSign = self::sign($params, $body, $secret);

        return 0 == strcmp($remoteSign, $localSign);
    }

    private static function getHeaderMap(): array
    {
        $headerMap = [];
        $signList = $_SERVER['HTTP_TOP_SIGN_LIST']; // 只获取参与签名的头部字段

        if (!$signList) {
            return $headerMap;
        }

        $signList = trim($signList);
        if (\strlen($signList) > 0) {
            $params = preg_split('/,/D', $signList);
            foreach ($_SERVER as $k => $v) {
                if ('HTTP_' == substr($k, 0, 5)) {
                    foreach ($params as $kk) {
                        $upperkey = strtoupper($kk);
                        if (self::endWith($k, $upperkey)) {
                            $headerMap[$kk] = $v;
                        }
                    }
                }
            }
        }

        return $headerMap;
    }

    private static function getQueryMap()
    {
        $queryStr = $_SERVER['QUERY_STRING'];
        $resultArray = [];
        foreach (explode('&', $queryStr) as $pair) {
            list($key, $value) = explode('=', $pair);
            if (false !== strpos($key, '.')) {
                list($subKey, $subVal) = explode('.', $key);

                if (preg_match('/(?P<name>\w+)\[(?P<index>\w+)\]/', $subKey, $matches)) {
                    $resultArray[$matches['name']][$matches['index']][$subVal] = $value;
                } else {
                    $resultArray[$subKey][$subVal] = urldecode($value);
                }
            } else {
                $resultArray[$key] = urldecode($value);
            }
        }

        return $resultArray;
    }

    private static function checkRemoteIp()
    {
        $remoteIp = $_SERVER['REMOTE_ADDR'];
        foreach ($header_real_ip as $k) {
            $realIp = $_SERVER[$k];
            $realIp = trim($realIp);
            if (\strlen($realIp) > 0 && strcasecmp('unknown', $realIp)) {
                $remoteIp = $realIp;

                break;
            }
        }

        return self::startsWith($remoteIp, '140.205.144.') || self::startsWith($remoteIp, '40.205.145.');
    }

    private static function getFormMap()
    {
        $resultArray = [];
        foreach ($_POST as $key => $v) {
            $resultArray[$key] = $v;
        }

        return $resultArray;
    }

    private static function startsWith($haystack, $needle): bool
    {
        return '' === $needle || 0 === strpos($haystack, $needle);
    }

    private static function endWith($haystack, $needle): bool
    {
        $length = \strlen($needle);
        if (0 == $length) {
            return true;
        }

        return substr($haystack, -$length) === $needle;
    }

    private static function checkTimestamp()
    {
        $ts = $_POST['timestamp'];
        if ($ts) {
            $clientTimestamp = strtotime($ts);
            $current = $_SERVER['REQUEST_TIME'];

            return ($current - $clientTimestamp) <= 5 * 60 * 1000;
        }

        return false;
    }

    private static function getParamStrFromMap($params): string
    {
        ksort($params);
        $stringToBeSigned = '';
        foreach ($params as $k => $v) {
            if (0 != strcmp('sign', $k)) {
                $stringToBeSigned .= "{$k}{$v}";
            }
        }
        unset($k, $v);

        return $stringToBeSigned;
    }

    private static function sign($params, $body, $secret): string
    {
        ksort($params);

        $stringToBeSigned = $secret;
        $stringToBeSigned .= self::getParamStrFromMap($params);

        if ($body) {
            $stringToBeSigned .= $body;
        }
        $stringToBeSigned .= $secret;

        return strtoupper(md5($stringToBeSigned));
    }

    private static function clear_blank($str, $glue = '')
    {
        $replace = [' ', "\r", "\n", "\t"];

        return str_replace($replace, $glue, $str);
    }
}
