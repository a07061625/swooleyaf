<?php
namespace AliOpen\Core\Http;

use AliOpen\Core\Exception\ClientException;

class HttpHelper {
    /**
     * @var int
     */
    public static $connectTimeout = 30;//30 second
    /**
     * @var int
     */
    public static $readTimeout = 80;//80 second

    /**
     * @param string $url
     * @param string $httpMethod
     * @param null $postFields
     * @param null $headers
     * @return \AliOpen\Core\Http\HttpResponse
     * @throws \AliOpen\Core\Exception\ClientException
     */
    public static function curl($url,$httpMethod = 'GET',$postFields = null,$headers = null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $httpMethod);
        if (ALIOPEN_ENABLE_HTTP_PROXY) {
            curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_PROXY, ALIOPEN_HTTP_PROXY_IP);
            curl_setopt($ch, CURLOPT_PROXYPORT, ALIOPEN_HTTP_PROXY_PORT);
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($postFields) ? self::getPostHttpBody($postFields) : $postFields);

        if (self::$readTimeout) {
            curl_setopt($ch, CURLOPT_TIMEOUT, self::$readTimeout);
        }
        if (self::$connectTimeout) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::$connectTimeout);
        }
        //https request
        if (strlen($url) > 5 && stripos($url, 'https') === 0) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        if (is_array($headers) && 0 < count($headers)) {
            $httpHeaders = self::getHttpHearders($headers);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeaders);
        }
        $httpResponse = new HttpResponse();
        $httpResponse->setBody(curl_exec($ch));
        $httpResponse->setStatus(curl_getinfo($ch, CURLINFO_HTTP_CODE));
        if (curl_errno($ch)) {
            throw new ClientException('Server unreachable: Errno: ' . curl_errno($ch) . ' ' . curl_error($ch), 'SDK.ServerUnreachable');
        }
        curl_close($ch);

        return $httpResponse;
    }

    /**
     * @param array $postFields
     * @return bool|string
     */
    public static function getPostHttpBody($postFields){
        $content = '';
        foreach ($postFields as $apiParamKey => $apiParamValue) {
            $content .= $apiParamKey . '=' . urlencode($apiParamValue) . '&';
        }

        return substr($content, 0, - 1);
    }

    /**
     * @param $headers
     * @return array
     */
    public static function getHttpHearders($headers){
        $httpHeader = [];
        foreach ($headers as $key => $value) {
            $httpHeader[] = $key . ':' . $value;
        }

        return $httpHeader;
    }
}
