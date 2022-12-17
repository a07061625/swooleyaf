<?php

namespace SyDingTalk;

class TalkClient
{
    /** @Author chaohui.zch copy from TopClient and modify 2016-12-14 * */

    /** @Author chaohui.zch modify $gatewayUrl 2017-07-18 * */
    public $gatewayUrl = 'https://eco.taobao.com/router/rest';
    public $format = 'xml';
    public $connectTimeout;
    public $readTimeout;
    public $apiCallType;
    public $httpMethod;
    /** 是否打开入参check*/
    public $checkRequest = true;
    protected $apiVersion = '2.0';
    protected $sdkVersion = 'dingtalk-sdk-php-20161214';

    public function __construct($apiCallType = null, $httpMethod = null, $format = 'xml')
    {
        $this->apiCallType = $apiCallType;
        $this->httpMethod = $httpMethod;
        $this->format = $format;
    }

    /**
     * @throws \Exception
     *
     * @param mixed      $url
     * @param null|mixed $postFields
     */
    public function curl($url, $postFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($this->readTimeout) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->readTimeout);
        }
        if ($this->connectTimeout) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        }
        curl_setopt($ch, CURLOPT_USERAGENT, 'dingtalk-sdk-php');
        //https 请求
        if (\strlen($url) > 5 && 'https' == strtolower(substr($url, 0, 5))) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        if (\is_array($postFields) && !empty($postFields)) {
            $postBodyString = '';
            $postMultipart = false;
            foreach ($postFields as $k => $v) {
                if ('@' != substr($v, 0, 1)) {//判断是不是文件上传
                    $postBodyString .= "{$k}=" . urlencode($v) . '&';
                } else {//文件上传用multipart/form-data，否则用www-form-urlencoded
                    $postMultipart = true;
                    if (class_exists('\CURLFile')) {
                        $postFields[$k] = new \CURLFile(substr($v, 1));
                    }
                }
            }
            unset($k, $v);
            curl_setopt($ch, CURLOPT_POST, true);
            if ($postMultipart) {
                if (class_exists('\CURLFile')) {
                    curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
                } else {
                    if (\defined('CURLOPT_SAFE_UPLOAD')) {
                        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
                    }
                }
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            } else {
                $header = ['content-type: application/x-www-form-urlencoded; charset=UTF-8'];
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString, 0, -1));
            }
        }

        $reponse = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new \Exception(curl_error($ch), 0);
        }
        $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (200 !== $httpStatusCode) {
            throw new \Exception($reponse, $httpStatusCode);
        }

        curl_close($ch);

        return $reponse;
    }

    /**
     * @throws \Exception
     *
     * @param mixed      $url
     * @param null|mixed $apiFields
     */
    public function curl_get($url, $apiFields = null)
    {
        $ch = curl_init();

        foreach ($apiFields as $key => $value) {
            if (!\is_string($value)) {
                $value = json_encode($value);
            }
            $url .= '&' . "{$key}=" . urlencode($value);
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        if ($this->readTimeout) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->readTimeout);
        }

        if ($this->connectTimeout) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        }

        curl_setopt($ch, CURLOPT_USERAGENT, 'dingtalk-sdk-php');

        //https ignore ssl check ?
        if (\strlen($url) > 5 && 'https' == strtolower(substr($url, 0, 5))) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        $reponse = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception(curl_error($ch), 0);
        }
        $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (200 !== $httpStatusCode) {
            throw new \Exception($reponse, $httpStatusCode);
        }

        curl_close($ch);

        return $reponse;
    }

    /**
     * @throws \Exception
     *
     * @param mixed      $url
     * @param null|mixed $postFields
     */
    public function curl_json($url, $postFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($this->readTimeout) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->readTimeout);
        }
        if ($this->connectTimeout) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        }
        curl_setopt($ch, CURLOPT_USERAGENT, 'dingtalk-sdk-php');
        //https 请求
        if (\strlen($url) > 5 && 'https' == strtolower(substr($url, 0, 5))) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        if (\is_array($postFields) && 0 < \count($postFields)) {
            $postBodyString = '';
            $postMultipart = false;
            foreach ($postFields as $k => $v) {
                if (!\is_string($v)) {
                    $v = json_encode($v);
                }
                if ('@' != substr($v, 0, 1)) {//判断是不是文件上传
                    $postBodyString .= "{$k}=" . urlencode($v) . '&';
                } else {//文件上传用multipart/form-data，否则用www-form-urlencoded
                    $postMultipart = true;
                    if (class_exists('\CURLFile')) {
                        $postFields[$k] = new \CURLFile(substr($v, 1));
                    }
                }
            }
            unset($k, $v);
            curl_setopt($ch, CURLOPT_POST, true);
            if ($postMultipart) {
                if (class_exists('\CURLFile')) {
                    curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
                } else {
                    if (\defined('CURLOPT_SAFE_UPLOAD')) {
                        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
                    }
                }
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            } else {
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json; charset=utf-8',
                    'Content-Length:' . \strlen(json_encode($postFields)),
                ]);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postFields));
            }
        }
        $reponse = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception(curl_error($ch), 0);
        }
        $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (200 !== $httpStatusCode) {
            throw new \Exception($reponse, $httpStatusCode);
        }

        curl_close($ch);

        return $reponse;
    }

    /**
     * @throws \Exception
     *
     * @param mixed      $url
     * @param null|mixed $postFields
     * @param null|mixed $fileFields
     */
    public function curl_with_memory_file($url, $postFields = null, $fileFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($this->readTimeout) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->readTimeout);
        }
        if ($this->connectTimeout) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        }
        curl_setopt($ch, CURLOPT_USERAGENT, 'dingtalk-sdk-php');
        //https 请求
        if (\strlen($url) > 5 && 'https' == strtolower(substr($url, 0, 5))) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        //生成分隔符
        $delimiter = '-------------' . uniqid();
        //先将post的普通数据生成主体字符串
        $data = '';
        if (null != $postFields) {
            foreach ($postFields as $name => $content) {
                $data .= '--' . $delimiter . "\r\n";
                $data .= 'Content-Disposition: form-data; name="' . $name . '"';
                //multipart/form-data 不需要urlencode，参见 http:stackoverflow.com/questions/6603928/should-i-url-encode-post-data
                $data .= "\r\n\r\n" . $content . "\r\n";
            }
            unset($name, $content);
        }

        //将上传的文件生成主体字符串
        if (null != $fileFields) {
            foreach ($fileFields as $name => $file) {
                $data .= '--' . $delimiter . "\r\n" . 'Content-Disposition: form-data; name="' . $name . '"; filename="' . $file['filename']
                         . "\" \r\n" . 'Content-Type: ' . $file['type'] . "\r\n\r\n" . $file['content'] . "\r\n";
            }
            unset($name, $file);
        }
        //主体结束的分隔符
        $data .= '--' . $delimiter . '--';

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: multipart/form-data; boundary=' . $delimiter,
            'Content-Length: ' . \strlen($data),
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $reponse = curl_exec($ch);
        unset($data);

        if (curl_errno($ch)) {
            throw new \Exception(curl_error($ch), 0);
        }
        $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (200 !== $httpStatusCode) {
            throw new \Exception($reponse, $httpStatusCode);
        }

        curl_close($ch);

        return $reponse;
    }

    public function execute($request, $session = null, $bestUrl = null)
    {
        if (TalkConstant::$CALL_TYPE_OAPI == $this->apiCallType) {
            return $this->_executeOapi($request, $session, $bestUrl, null, null, null, null);
        }

        return $this->_execute($request, $session, $bestUrl);
    }

    public function executeWithAccessKey($request, $bestUrl, $accessKey, $accessSecret)
    {
        return $this->executeWithCorpId($request, $bestUrl, $accessKey, $accessSecret, null, null);
    }

    public function executeWithSuiteTicket($request, $bestUrl, $accessKey, $accessSecret, $suiteTicket)
    {
        return $this->executeWithCorpId($request, $bestUrl, $accessKey, $accessSecret, $suiteTicket, null);
    }

    public function executeWithCorpId($request, $bestUrl, $accessKey, $accessSecret, $suiteTicket, $corpId)
    {
        if (TalkConstant::$CALL_TYPE_OAPI == $this->apiCallType) {
            return $this->_executeOapi($request, null, $bestUrl, $accessKey, $accessSecret, $suiteTicket, $corpId);
        }

        return $this->_execute($request, null, $bestUrl);
    }

    protected function logCommunicationError($apiName, $requestUrl, $errorCode, $responseTxt)
    {
        $localIp = $_SERVER['SERVER_ADDR'] ?? 'CLI';
        \SyLog\Log::error(implode(PHP_EOL, [
            $apiName,
            $localIp,
            PHP_OS,
            $this->sdkVersion,
            $requestUrl,
            $errorCode,
            str_replace("\n", '', $responseTxt),
        ]), 111111);
    }

    private function _executeOapi($request, $session, $bestUrl, $accessKey, $accessSecret, $suiteTicket, $corpId)
    {
        $result = new ResultSet();
        if ($this->checkRequest) {
            try {
                $request->check();
            } catch (\Exception $e) {
                $result->code = $e->getCode();
                $result->msg = $e->getMessage();

                return $result;
            }
        }

        $sysParams['method'] = $request->getApiMethodName();
        //系统参数放入GET请求串
        if ($bestUrl) {
            if (false === strpos($bestUrl, '?')) {
                $requestUrl = $bestUrl . '?';
            } else {
                $requestUrl = $bestUrl;
            }
        } else {
            $requestUrl = $this->gatewayUrl . '?';
        }
        if (null != $accessKey) {
            $timestamp = $this->getMillisecond();
            // 验证签名有效性
            $canonicalString = $this->getCanonicalStringForIsv($timestamp, $suiteTicket);
            $signature = $this->computeSignature($accessSecret, $canonicalString);

            $queryParams['accessKey'] = $accessKey;
            $queryParams['signature'] = $signature;
            $queryParams['timestamp'] = $timestamp . '';
            if (null != $suiteTicket) {
                $queryParams['suiteTicket'] = $suiteTicket;
            }
            if (null != $corpId) {
                $queryParams['corpId'] = $corpId;
            }
            foreach ($queryParams as $queryParamKey => $queryParamValue) {
                $requestUrl .= "{$queryParamKey}=" . urlencode($queryParamValue) . '&';
            }
        } else {
            $requestUrl .= 'access_token=' . urlencode($session) . '&';
        }

        //获取业务参数
        $apiParams = $request->getApiParas();
        $fileFields = [];
        foreach ($apiParams as $key => $value) {
            if (\is_array($value) && \array_key_exists('type', $value) && \array_key_exists('content', $value)) {
                $value['name'] = $key;
                $fileFields[$key] = $value;
                unset($apiParams[$key]);
            }
        }

        $requestUrl = substr($requestUrl, 0, -1);

        //发起HTTP请求
        try {
            if (empty($fileFields)) {
                if (TalkConstant::$METHOD_POST == $this->httpMethod) {
                    $resp = $this->curl_json($requestUrl, $apiParams);
                } else {
                    $resp = $this->curl_get($requestUrl, $apiParams);
                }
            } else {
                $resp = $this->curl_with_memory_file($requestUrl, $apiParams, $fileFields);
            }
        } catch (\Exception $e) {
            $this->logCommunicationError($sysParams['method'], $requestUrl, 'HTTP_ERROR_' . $e->getCode(), $e->getMessage());
            $result->code = $e->getCode();
            $result->msg = $e->getMessage();

            return $result;
        }

        unset($apiParams, $fileFields);

        //解析TOP返回结果
        $respWellFormed = false;
        if ('json' == $this->format) {
            $respObject = json_decode($resp);
            if (null !== $respObject) {
                $respWellFormed = true;
            }
        } elseif ('xml' == $this->format) {
            $respObject = @simplexml_load_string($resp);
            if (false !== $respObject) {
                $respWellFormed = true;
            }
        }

        //返回的HTTP文本不是标准JSON或者XML，记下错误日志
        if (false === $respWellFormed) {
            $this->logCommunicationError($sysParams['method'], $requestUrl, 'HTTP_RESPONSE_NOT_WELL_FORMED', $resp);
            $result->code = 0;
            $result->msg = 'HTTP_RESPONSE_NOT_WELL_FORMED';

            return $result;
        }

        //如果TOP返回了错误码，记录到业务错误日志中
        if (isset($respObject->code)) {
            \SyLog\Log::error($resp);
        }

        return $respObject;
    }

    private function getMillisecond(): float
    {
        list($s1, $s2) = explode(' ', microtime());

        return (float)sprintf('%.0f', ((float)$s1 + (float)$s2) * 1000);
    }

    private function getCanonicalStringForIsv($timestamp, $suiteTicket)
    {
        $result = $timestamp;
        if (null != $suiteTicket) {
            $result .= "\n" . $suiteTicket;
        }

        return $result;
    }

    private function computeSignature($accessSecret, $canonicalString): string
    {
        $s = hash_hmac('sha256', $canonicalString, $accessSecret, true);

        return base64_encode($s);
    }

    private function _execute($request, $session = null, $bestUrl = null)
    {
        $result = new ResultSet();
        if ($this->checkRequest) {
            try {
                $request->check();
            } catch (\Exception $e) {
                $result->code = $e->getCode();
                $result->msg = $e->getMessage();

                return $result;
            }
        }
        //组装系统参数
        $sysParams['v'] = $this->apiVersion;
        $sysParams['format'] = $this->format;
        $sysParams['method'] = $request->getApiMethodName();
        $sysParams['timestamp'] = date('Y-m-d H:i:s');
        if (null != $session) {
            $sysParams['session'] = $session;
        }
        $apiParams = [];
        //获取业务参数
        $apiParams = $request->getApiParas();

        //系统参数放入GET请求串
        if ($bestUrl) {
            if (false === strpos($bestUrl, '?')) {
                $requestUrl = $bestUrl . '?';
            } else {
                $requestUrl = $bestUrl;
            }
            $sysParams['partner_id'] = $this->getClusterTag();
        } else {
            $requestUrl = $this->gatewayUrl . '?';
            $sysParams['partner_id'] = $this->sdkVersion;
        }

        foreach ($sysParams as $sysParamKey => $sysParamValue) {
            $requestUrl .= "{$sysParamKey}=" . urlencode($sysParamValue) . '&';
        }

        $fileFields = [];
        foreach ($apiParams as $key => $value) {
            if (\is_array($value) && \array_key_exists('type', $value) && \array_key_exists('content', $value)) {
                $value['name'] = $key;
                $fileFields[$key] = $value;
                unset($apiParams[$key]);
            }
        }

        $requestUrl = substr($requestUrl, 0, -1);

        //发起HTTP请求
        try {
            if (empty($fileFields)) {
                $resp = $this->curl($requestUrl, $apiParams);
            } else {
                $resp = $this->curl_with_memory_file($requestUrl, $apiParams, $fileFields);
            }
        } catch (\Exception $e) {
            $this->logCommunicationError($sysParams['method'], $requestUrl, 'HTTP_ERROR_' . $e->getCode(), $e->getMessage());
            $result->code = $e->getCode();
            $result->msg = $e->getMessage();

            return $result;
        }

        unset($apiParams, $fileFields);
        //解析TOP返回结果
        $respWellFormed = false;
        if ('json' == $this->format) {
            $respObject = json_decode($resp);
            if (null !== $respObject) {
                $respWellFormed = true;
                foreach ($respObject as $propKey => $propValue) {
                    $respObject = $propValue;
                }
            }
        } elseif ('xml' == $this->format) {
            $respObject = @simplexml_load_string($resp);
            if (false !== $respObject) {
                $respWellFormed = true;
            }
        }

        //返回的HTTP文本不是标准JSON或者XML，记下错误日志
        if (false === $respWellFormed) {
            $this->logCommunicationError($sysParams['method'], $requestUrl, 'HTTP_RESPONSE_NOT_WELL_FORMED', $resp);
            $result->code = 0;
            $result->msg = 'HTTP_RESPONSE_NOT_WELL_FORMED';

            return $result;
        }

        //如果TOP返回了错误码，记录到业务错误日志中
        if (isset($respObject->code)) {
            \SyLog\Log::error($resp);
        }

        return $respObject;
    }

    private function getClusterTag(): string
    {
        return substr($this->sdkVersion, 0, 11) . '-cluster' . substr($this->sdkVersion, 11);
    }
}
