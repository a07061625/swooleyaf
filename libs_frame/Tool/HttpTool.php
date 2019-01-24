<?php
/**
 * HTTP处理工具类
 * User: jw
 * Date: 17-7-2
 * Time: 上午11:50
 */
namespace Tool;

use Log\Log;
use Traits\SimpleTrait;

final class HttpTool {
    use SimpleTrait;

    //支持解析的协议列表
    private static $protocols = [
        'HTTP/1.0',
        'HTTP/1.1',
        'HTTP/2.0',
    ];

    private static function parseResponseCookie(string $rspCookie) {
        $cookie = [];
        $saveArr = explode(';', $rspCookie);
        foreach ($saveArr as $key1 => $val1) {
            list($key2, $val2) = explode('=', $val1);
            $trueKey = trim($key2);
            $trueVal = trim($val2);
            if (($key1 > 0) && ($trueKey != 'expires')) {
                $cookie[$trueKey] = $trueVal;
            } else if ($trueKey == 'expires') {
                $cookie['expires'] = strtotime($trueVal);
            } else {
                $cookie['key'] = $trueKey;
                $cookie['value'] = urldecode($trueVal);
            }
        }

        return $cookie;
    }

    /**
     * 解析http响应消息
     * @param string $rspMessage 响应消息字符串
     * @return array|bool
     */
    public static function parseResponse(string $rspMessage) {
        $resArr = [
            'status' => 200,
            'headers' => [],
            'cookies' => [],
            'body' => '',
        ];

        $rspData = explode("\r\n\r\n", $rspMessage);
        if (count($rspData) != 2) {
            Log::error('response invalid');
            return false;
        }

        //解析响应头
        $headerData = preg_replace('/\s{2,}/', ' ', explode("\r\n", $rspData[0]));
        //解析响应状态信息
        $rspStatus = explode(' ', $headerData[0]);
        if(!in_array($rspStatus[0], self::$protocols)){
            Log::error('response protocol invalid');
            return false;
        } else if (!isset($rspStatus[1])) {
            Log::error('response status not exist');
            return false;
        } else if (!is_numeric($rspStatus[1])) {
            Log::error('response status invalid');
            return false;
        } else {
            $resArr['status'] = (int)$rspStatus[1];
        }
        unset($headerData[0], $rspStatus);

        foreach ($headerData as $header) {
            $pos = strpos($header, ':');
            if (!$pos) {
                Log::error('response header invalid');
                return false;
            }

            $name = trim(substr($header, 0, $pos));
            $value = trim(substr($header, ($pos + 1)));
            if (strcasecmp($name, 'Set-Cookie') != 0) {
                $resArr['headers'][$name] = $value;
            } else {
                if (!isset($resArr['header']['Set-Cookie'])) {
                    $resArr['headers']['Set-Cookie'] = [];
                }
                $resArr['headers']['Set-Cookie'][] = $value;
                $resArr['cookies'][] = self::parseResponseCookie($value);
            }
        }
        unset($headerData);

        //获取响应体
        $contentLength = (int)Tool::getArrayVal($resArr['headers'], 'Content-Length', 0);
        $resArr['body'] = substr($rspData[1], 0, $contentLength);
        unset($rspData);
        return $resArr;
    }

    /**
     * 获取请求头字符串
     * cookie数组数据格式如下：
     * <pre>
     * [
     *     'aaa' => 123,
     *     'bbb' => 123,
     * ]
     * </pre>
     * @param string $method 请求方式
     * @param string $uri 请求URI
     * @param array $headers 请求头数组
     * @param array $cookies cookie数组
     * @return string
     */
    public static function getReqHeaderStr(string $method,string $uri,array $headers,array $cookies=[]) : string {
        $reqHeaderStr = $method . " " . $uri . " HTTP/1.1\r\n\r\n";
        if (!empty($cookies)) {
            $cookieStr = '';
            foreach ($cookies as $cookieName => $cookieVal) {
                $cookieStr .= '; ' . $cookieName . '=' . urlencode($cookieVal);
            }
            $headers['Cookie'] = substr($cookieStr, 2);
        }
        foreach ($headers as $headerName => $headerVal) {
            $reqHeaderStr .= $headerName . ':' . $headerVal . "\r\n";
        }

        return $reqHeaderStr;
    }
}