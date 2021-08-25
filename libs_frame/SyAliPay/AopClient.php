<?php

namespace SyAliPay;

use function mb_convert_encoding;
use function mb_detect_encoding;
use SyConstant\ErrorCode;
use SyException\Common\CheckException;
use SyLog\Log;

class AopClient
{
    //应用ID
    public $appId;
    //私钥文件路径
    public $rsaPrivateKeyFilePath;
    //私钥值
    public $rsaPrivateKey;
    //网关
    public $gatewayUrl = 'https://openapi.alipay.com/gateway.do';
    //返回数据格式
    public $format = 'json';
    //api版本
    public $apiVersion = '1.0';
    // 表单提交字符集编码
    public $postCharset = 'UTF-8';
    //使用文件读取文件格式，请只传递该值
    public $alipayPublicKey;
    //使用读取字符串格式，请只传递该值
    public $alipayrsaPublicKey;
    public $debugInfo = false;
    //签名类型
    public $signType = 'RSA';
    //加密密钥和类型
    public $encryptKey;
    public $encryptType = 'AES';

    protected $alipaySdkVersion = 'alipay-sdk-PHP-4.11.14.ALL';
    private $fileCharset = 'UTF-8';
    private $RESPONSE_SUFFIX = '_response';
    private $ERROR_RESPONSE = 'error_response';
    private $SIGN_NODE_NAME = 'sign';
    //加密XML节点名称
    private $ENCRYPT_XML_NODE_NAME = 'response_encrypted';
    private $needEncrypt = false;
    private $targetServiceUrl = '';
    private $syExpireTime = 0;
    private $syValid = false;

    public function getSyExpireTime(): int
    {
        return $this->syExpireTime;
    }

    public function setSyExpireTime(int $syExpireTime)
    {
        $this->syExpireTime = $syExpireTime;
    }

    public function isSyValid(): bool
    {
        return $this->syValid;
    }

    public function setSyValid(bool $syValid)
    {
        $this->syValid = $syValid;
    }

    public function generateSign($params, $signType = 'RSA'): string
    {
        $params = array_filter($params);
        $params['sign_type'] = $signType;

        return $this->sign($this->getSignContent($params), $signType);
    }

    public function rsaSign($params, $signType = 'RSA'): string
    {
        return $this->sign($this->getSignContent($params), $signType);
    }

    public function getSignContent($params): string
    {
        ksort($params);
        unset($params['sign']);

        $stringToBeSigned = '';
        $i = 0;
        foreach ($params as $k => $v) {
            if ('@' != substr($v, 0, 1)) {
                // 转换成目标字符集
                $v = $this->characet($v, $this->postCharset);

                if (0 == $i) {
                    $stringToBeSigned .= "{$k}" . '=' . "{$v}";
                } else {
                    $stringToBeSigned .= '&' . "{$k}" . '=' . "{$v}";
                }
                ++$i;
            }
        }

        unset($k, $v);

        return $stringToBeSigned;
    }

    //此方法对value做urlencode
    public function getSignContentUrlencode($params): string
    {
        ksort($params);

        $stringToBeSigned = '';
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === $this->checkEmpty($v) && '@' != substr($v, 0, 1)) {
                // 转换成目标字符集
                $v = $this->characet($v, $this->postCharset);

                if (0 == $i) {
                    $stringToBeSigned .= "{$k}" . '=' . urlencode($v);
                } else {
                    $stringToBeSigned .= '&' . "{$k}" . '=' . urlencode($v);
                }
                ++$i;
            }
        }

        unset($k, $v);

        return $stringToBeSigned;
    }

    /**
     * RSA单独签名方法，未做字符串处理,字符串处理见getSignContent()
     *
     * @param string $data        待签名字符串
     * @param string $privatekey  商户私钥，根据keyfromfile来判断是读取字符串还是读取文件，false:填写私钥字符串去回车和空格 true:填写私钥文件路径
     * @param string $signType    签名方式，RSA:SHA1     RSA2:SHA256
     * @param bool   $keyfromfile 私钥获取方式，读取字符串还是读文件
     */
    public function alonersaSign(
        string $data,
        string $privatekey,
        string $signType = 'RSA',
        bool $keyfromfile = false
    ): string {
        if (!$keyfromfile) {
            $priKey = $privatekey;
            $res = "-----BEGIN RSA PRIVATE KEY-----\n"
                   . wordwrap($priKey, 64, "\n", true)
                   . "\n-----END RSA PRIVATE KEY-----";
        } else {
            $priKey = file_get_contents($privatekey);
            $res = openssl_get_privatekey($priKey);
        }

        ($res) || die('您使用的私钥格式错误，请检查RSA私钥配置');

        if ('RSA2' == $signType) {
            openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        } else {
            openssl_sign($data, $sign, $res);
        }

        if ($keyfromfile) {
            openssl_free_key($res);
        }

        return base64_encode($sign);
    }

    /**
     * 生成用于调用收银台SDK的字符串
     *
     * @param object      $request      SDK接口的请求参数对象
     * @param null|string $appAuthToken 三方应用授权token
     *
     * @return string
     */
    public function sdkExecute(object $request, ?string $appAuthToken = null)
    {
        $this->setupCharsets($request);

        $params['app_id'] = $this->appId;
        $params['method'] = $request->getApiMethodName();
        $params['format'] = $this->format;
        $params['sign_type'] = $this->signType;
        $params['timestamp'] = date('Y-m-d H:i:s');
        $params['alipay_sdk'] = $this->alipaySdkVersion;
        $params['charset'] = $this->postCharset;

        $version = $request->getApiVersion();
        $params['version'] = $this->checkEmpty($version) ? $this->apiVersion : $version;

        if ($notify_url = $request->getNotifyUrl()) {
            $params['notify_url'] = $notify_url;
        }

        $params['app_auth_token'] = $appAuthToken;

        $dict = $request->getApiParas();
        $params['biz_content'] = $dict['biz_content'];

        ksort($params);

        $params['sign'] = $this->generateSign($params, $this->signType);

        foreach ($params as &$value) {
            $value = $this->characet($value, $params['charset']);
        }

        return http_build_query($params);
    }

    /**
     * 页面提交执行方法
     *
     * @param object      $request      跳转类接口的request
     * @param string      $httpmethod   提交方式,两个值可选：post、get;
     * @param null|string $appAuthToken 三方应用授权token
     *
     * @return string 构建好的、签名后的最终跳转URL（GET）或String形式的form（POST）
     *
     * @throws \Exception
     */
    public function pageExecute(object $request, string $httpmethod = 'POST', ?string $appAuthToken = null)
    {
        $this->setupCharsets($request);

        if (strcasecmp($this->fileCharset, $this->postCharset)) {
            // writeLog("本地文件字符集编码与表单提交编码不一致，请务必设置成一样，属性名分别为postCharset!");
            throw new \Exception('文件编码：[' . $this->fileCharset . '] 与表单提交编码：[' . $this->postCharset . ']两者不一致!');
        }

        $iv = null;

        if (!$this->checkEmpty($request->getApiVersion())) {
            $iv = $request->getApiVersion();
        } else {
            $iv = $this->apiVersion;
        }

        //组装系统参数
        $sysParams['app_id'] = $this->appId;
        $sysParams['version'] = $iv;
        $sysParams['format'] = $this->format;
        $sysParams['sign_type'] = $this->signType;
        $sysParams['method'] = $request->getApiMethodName();
        $sysParams['timestamp'] = date('Y-m-d H:i:s');
        $sysParams['alipay_sdk'] = $this->alipaySdkVersion;
        if (!$this->checkEmpty($request->getTerminalType())) {
            $sysParams['terminal_type'] = $request->getTerminalType();
        }
        if (!$this->checkEmpty($request->getTerminalInfo())) {
            $sysParams['terminal_info'] = $request->getTerminalInfo();
        }
        if (!$this->checkEmpty($request->getProdCode())) {
            $sysParams['prod_code'] = $request->getProdCode();
        }
        if (!$this->checkEmpty($request->getNotifyUrl())) {
            $sysParams['notify_url'] = $request->getNotifyUrl();
        }
        if (!$this->checkEmpty($request->getReturnUrl())) {
            $sysParams['return_url'] = $request->getReturnUrl();
        }
        $sysParams['charset'] = $this->postCharset;
        if (!$this->checkEmpty($appAuthToken)) {
            $sysParams['app_auth_token'] = $appAuthToken;
        }

        //获取业务参数
        $apiParams = $request->getApiParas();

        if (method_exists($request, 'getNeedEncrypt') && $request->getNeedEncrypt()) {
            $sysParams['encrypt_type'] = $this->encryptType;

            if ($this->checkEmpty($apiParams['biz_content'])) {
                throw new \Exception(' api request Fail! The reason : encrypt request is not supperted!');
            }

            if ($this->checkEmpty($this->encryptKey) || $this->checkEmpty($this->encryptType)) {
                throw new \Exception(' encryptType and encryptKey must not null! ');
            }

            if ('AES' != $this->encryptType) {
                throw new \Exception('加密类型只支持AES');
            }

            // 执行加密
            $enCryptContent = AopEncrypt::encrypt($apiParams['biz_content'], $this->encryptKey);
            $apiParams['biz_content'] = $enCryptContent;
        }

        $totalParams = array_merge($apiParams, $sysParams);

        //待签名字符串
        $preSignStr = $this->getSignContent($totalParams);

        //签名
        $totalParams['sign'] = $this->generateSign($totalParams, $this->signType);

        if ('GET' == strtoupper($httpmethod)) {
            //value做urlencode
            $preString = $this->getSignContentUrlencode($totalParams);

            //拼接GET请求串
            return $this->gatewayUrl . '?' . $preString;
        }
        //拼接表单字符串
        return $this->buildRequestForm($totalParams);
    }

    /**
     * @throws \Exception
     *
     * @param mixed      $request
     * @param null|mixed $authToken
     * @param null|mixed $appInfoAuthtoken
     * @param null|mixed $targetAppId
     */
    public function execute($request, $authToken = null, $appInfoAuthtoken = null, $targetAppId = null)
    {
        $this->setupCharsets($request);

        //如果两者编码不一致，会出现签名验签或者乱码
        if (strcasecmp($this->fileCharset, $this->postCharset)) {
            $errMsg = '文件编码：[' . $this->fileCharset
                      . '] 与表单提交编码：[' . $this->postCharset
                      . ']两者不一致!';

            throw new \Exception($errMsg);
        }

        $iv = null;
        if (!$this->checkEmpty($request->getApiVersion())) {
            $iv = $request->getApiVersion();
        } else {
            $iv = $this->apiVersion;
        }

        //组装系统参数
        $sysParams['app_id'] = $this->appId;
        $sysParams['version'] = $iv;
        $sysParams['format'] = $this->format;
        $sysParams['sign_type'] = $this->signType;
        $sysParams['method'] = $request->getApiMethodName();
        $sysParams['timestamp'] = date('Y-m-d H:i:s');
        if (!$this->checkEmpty($authToken)) {
            $sysParams['auth_token'] = $authToken;
        }
        $sysParams['alipay_sdk'] = $this->alipaySdkVersion;
        if (!$this->checkEmpty($request->getTerminalType())) {
            $sysParams['terminal_type'] = $request->getTerminalType();
        }
        if (!$this->checkEmpty($request->getTerminalInfo())) {
            $sysParams['terminal_info'] = $request->getTerminalInfo();
        }
        if (!$this->checkEmpty($request->getProdCode())) {
            $sysParams['prod_code'] = $request->getProdCode();
        }
        if (!$this->checkEmpty($request->getNotifyUrl())) {
            $sysParams['notify_url'] = $request->getNotifyUrl();
        }
        $sysParams['charset'] = $this->postCharset;
        if (!$this->checkEmpty($appInfoAuthtoken)) {
            $sysParams['app_auth_token'] = $appInfoAuthtoken;
        }
        if (!$this->checkEmpty($targetAppId)) {
            $sysParams['target_app_id'] = $targetAppId;
        }
        if (!$this->checkEmpty($this->targetServiceUrl)) {
            $sysParams['ws_service_url'] = $this->targetServiceUrl;
        }

        //获取业务参数
        $apiParams = $request->getApiParas();

        if (method_exists($request, 'getNeedEncrypt') && $request->getNeedEncrypt()) {
            $sysParams['encrypt_type'] = $this->encryptType;

            if ($this->checkEmpty($apiParams['biz_content'])) {
                throw new \Exception(' api request Fail! The reason : encrypt request is not supperted!');
            }

            if ($this->checkEmpty($this->encryptKey) || $this->checkEmpty($this->encryptType)) {
                throw new \Exception(' encryptType and encryptKey must not null! ');
            }

            if ('AES' != $this->encryptType) {
                throw new \Exception('加密类型只支持AES');
            }

            // 执行加密
            $enCryptContent = AopEncrypt::encrypt($apiParams['biz_content'], $this->encryptKey);
            $apiParams['biz_content'] = $enCryptContent;
        }

        //签名
        $sysParams['sign'] = $this->generateSign(array_merge($apiParams, $sysParams), $this->signType);

        //系统参数放入GET请求串
        $requestUrl = $this->gatewayUrl . '?';
        foreach ($sysParams as $sysParamKey => $sysParamValue) {
            if (null != $sysParamValue) {
                $requestUrl .= "{$sysParamKey}=" . urlencode($this->characet($sysParamValue, $this->postCharset)) . '&';
            }
        }
        $requestUrl = substr($requestUrl, 0, -1);

        //发起HTTP请求
        try {
            $resp = $this->curl($requestUrl, $apiParams);
        } catch (\Exception $e) {
            $this->logCommunicationError(
                $sysParams['method'],
                $requestUrl,
                'HTTP_ERROR_' . $e->getCode(),
                $e->getMessage()
            );

            return false;
        }

        //解析AOP返回结果
        $respWellFormed = false;

        // 将返回结果转换本地文件编码
        $r = iconv($this->postCharset, $this->fileCharset . '//IGNORE', $resp);

        $signData = null;

        if ('json' == strtolower($this->format)) {
            $respObject = json_decode($r);
            if (null !== $respObject) {
                $respWellFormed = true;
                $signData = $this->parserJSONSignData($request, $resp, $respObject);
            }
        } elseif ('xml' == $this->format) {
            $disableLibxmlEntityLoader = libxml_disable_entity_loader(true);
            $respObject = @simplexml_load_string($resp);
            if (false !== $respObject) {
                $respWellFormed = true;

                $signData = $this->parserXMLSignData($request, $resp);
            }
            libxml_disable_entity_loader($disableLibxmlEntityLoader);
        }

        //返回的HTTP文本不是标准JSON或者XML，记下错误日志
        if (false === $respWellFormed) {
            var_dump(333);
            $this->logCommunicationError($sysParams['method'], $requestUrl, 'HTTP_RESPONSE_NOT_WELL_FORMED', $resp);

            return false;
        }

        // 验签
        $this->checkResponseSign($request, $signData, $resp, $respObject);

        // 解密
        if (method_exists($request, 'getNeedEncrypt') && $request->getNeedEncrypt()) {
            if ('json' == $this->format) {
                $resp = $this->encryptJSONSignSource($request, $resp);

                // 将返回结果转换本地文件编码
                $r = iconv($this->postCharset, $this->fileCharset . '//IGNORE', $resp);
                $respObject = json_decode($r);
            } else {
                $resp = $this->encryptXMLSignSource($request, $resp);

                $r = iconv($this->postCharset, $this->fileCharset . '//IGNORE', $resp);
                $disableLibxmlEntityLoader = libxml_disable_entity_loader(true);
                $respObject = @simplexml_load_string($r);
                libxml_disable_entity_loader($disableLibxmlEntityLoader);
            }
        }

        return $respObject;
    }

    /**
     * 转换字符集编码
     *
     * @param $data
     * @param $targetCharset
     */
    public function characet($data, $targetCharset): string
    {
        if (!empty($data)) {
            $fileType = $this->fileCharset;
            if (0 != strcasecmp($fileType, $targetCharset)) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
            }
        }

        return $data;
    }

    public function exec($paramsArray)
    {
        if (!isset($paramsArray['method'])) {
            trigger_error('No api name passed');
        }
        $inflector = new LtInflector();
        $inflector->conf['separator'] = '.';
        $requestClassName = ucfirst($inflector->camelize(substr($paramsArray['method'], 7))) . 'Request';
        if (!class_exists($requestClassName)) {
            trigger_error('No such api: ' . $paramsArray['method']);
        }

        $session = $paramsArray['session'] ?? null;

        $req = new $requestClassName();
        foreach ($paramsArray as $paraKey => $paraValue) {
            $inflector->conf['separator'] = '_';
            $setterMethodName = $inflector->camelize($paraKey);
            $inflector->conf['separator'] = '.';
            $setterMethodName = 'set' . $inflector->camelize($setterMethodName);
            if (method_exists($req, $setterMethodName)) {
                $req->{$setterMethodName}($paraValue);
            }
        }

        return $this->execute($req, $session);
    }

    /** rsaCheckV1 & rsaCheckV2
     *  验证签名
     *  在使用本方法前，必须初始化AopClient且传入公钥参数。
     *  公钥是否是读取字符串还是读取文件，是根据初始化传入的值判断的。
     *
     * @param mixed $params
     * @param mixed $rsaPublicKeyFilePath
     * @param mixed $signType
     */
    public function rsaCheckV1($params, $rsaPublicKeyFilePath, $signType = 'RSA'): bool
    {
        $sign = $params['sign'];
        unset($params['sign'], $params['sign_type']);

        return $this->verify($this->getSignContent($params), $sign, $rsaPublicKeyFilePath, $signType);
    }

    public function rsaCheckV2($params, $rsaPublicKeyFilePath, $signType = 'RSA'): bool
    {
        $sign = $params['sign'];
        unset($params['sign']);

        return $this->verify($this->getSignContent($params), $sign, $rsaPublicKeyFilePath, $signType);
    }

    public function verify($data, $sign, $rsaPublicKeyFilePath, $signType = 'RSA'): bool
    {
        if ($this->checkEmpty($this->alipayPublicKey)) {
            $pubKey = $this->alipayrsaPublicKey;
            $res = "-----BEGIN PUBLIC KEY-----\n"
                   . wordwrap($pubKey, 64, "\n", true)
                   . "\n-----END PUBLIC KEY-----";
        } else {
            //读取公钥文件
            $pubKey = file_get_contents($rsaPublicKeyFilePath);
            //转换为openssl格式密钥
            $res = openssl_get_publickey($pubKey);
        }

        ($res) || die('支付宝RSA公钥错误。请检查公钥文件格式是否正确');

        //调用openssl内置方法验签，返回bool值

        $result = false;
        if ('RSA2' == $signType) {
            $result = (1 === openssl_verify($data, base64_decode($sign), $res, OPENSSL_ALGO_SHA256));
        } else {
            $result = (1 === openssl_verify($data, base64_decode($sign), $res));
        }

        if (!$this->checkEmpty($this->alipayPublicKey)) {
            //释放资源
            openssl_free_key($res);
        }

        return $result;
    }

    /**
     *  在使用本方法前，必须初始化AopClient且传入公私钥参数。
     *  公钥是否是读取字符串还是读取文件，是根据初始化传入的值判断的。
     *
     * @param mixed $params
     * @param mixed $rsaPublicKeyPem
     * @param mixed $rsaPrivateKeyPem
     * @param mixed $isCheckSign
     * @param mixed $isDecrypt
     * @param mixed $signType
     *
     * @throws \SyException\Common\CheckException
     */
    public function checkSignAndDecrypt(
        $params,
        $rsaPublicKeyPem,
        $rsaPrivateKeyPem,
        $isCheckSign,
        $isDecrypt,
        $signType = 'RSA'
    ) {
        $charset = $params['charset'];
        $bizContent = $params['biz_content'];
        if ($isCheckSign) {
            if (!$this->rsaCheckV2($params, $rsaPublicKeyPem, $signType)) {
                throw new CheckException('checkSign failure', ErrorCode::COMMON_PARAM_ERROR);
            }
        }
        if ($isDecrypt) {
            return $this->rsaDecrypt($bizContent, $rsaPrivateKeyPem, $charset);
        }

        return $bizContent;
    }

    /**
     *  在使用本方法前，必须初始化AopClient且传入公私钥参数。
     *  公钥是否是读取字符串还是读取文件，是根据初始化传入的值判断的。
     *
     * @param mixed $bizContent
     * @param mixed $rsaPublicKeyPem
     * @param mixed $rsaPrivateKeyPem
     * @param mixed $charset
     * @param mixed $isEncrypt
     * @param mixed $isSign
     * @param mixed $signType
     */
    public function encryptAndSign(
        $bizContent,
        $rsaPublicKeyPem,
        $rsaPrivateKeyPem,
        $charset,
        $isEncrypt,
        $isSign,
        $signType = 'RSA'
    ): string {
        $resStr = '<?xml version="1.0" encoding="' . $charset . '"?>';
        if ($isEncrypt && $isSign) { //加密并签名
            $encrypted = $this->rsaEncrypt($bizContent, $rsaPublicKeyPem, $charset);
            $sign = $this->sign($encrypted, $signType);
            $resStr .= '<alipay><response>' . $encrypted
                       . '</response><encryption_type>RSA</encryption_type><sign>' . $sign
                       . '</sign><sign_type>' . $signType
                       . '</sign_type></alipay>';
        } elseif ($isEncrypt) { //加密不签名
            $encrypted = $this->rsaEncrypt($bizContent, $rsaPublicKeyPem, $charset);
            $resStr .= '<alipay><response>' . $encrypted
                       . '</response><encryption_type>' . $signType
                       . '</encryption_type></alipay>';
        } elseif ($isSign) { //签名不加密
            $sign = $this->sign($bizContent, $signType);
            $resStr .= '<alipay><response>' . $bizContent
                       . '</response><sign>' . $sign
                       . '</sign><sign_type>' . $signType
                       . '</sign_type></alipay>';
        } else { //不加密不签名
            $resStr .= $bizContent;
        }

        return $resStr;
    }

    /**
     *  在使用本方法前，必须初始化AopClient且传入公私钥参数。
     *  公钥是否是读取字符串还是读取文件，是根据初始化传入的值判断的。
     *
     * @param mixed $data
     * @param mixed $rsaPublicKeyFilePath
     * @param mixed $charset
     *
     * @throws \SyException\Common\CheckException
     */
    public function rsaEncrypt($data, $rsaPublicKeyFilePath, $charset): string
    {
        if ($this->checkEmpty($this->alipayPublicKey)) {
            //读取字符串
            $pubKey = $this->alipayrsaPublicKey;
            $res = "-----BEGIN PUBLIC KEY-----\n"
                   . wordwrap($pubKey, 64, "\n", true)
                   . "\n-----END PUBLIC KEY-----";
        } else {
            //读取公钥文件
            $pubKey = file_get_contents($rsaPublicKeyFilePath);
            //转换为openssl格式密钥
            $res = openssl_get_publickey($pubKey);
        }

        if (!$res) {
            throw new CheckException('支付宝RSA公钥错误,请检查公钥文件格式是否正确', ErrorCode::COMMON_PARAM_ERROR);
        }
        $blocks = $this->splitCN($data, 0, 30, $charset);
        $chrtext = null;
        $encodes = [];
        foreach ($blocks as $n => $block) {
            if (!openssl_public_encrypt($block, $chrtext, $res)) {
                throw new CheckException(openssl_error_string(), ErrorCode::COMMON_PARAM_ERROR);
            }
            $encodes[] = $chrtext;
        }

        return base64_encode(implode(',', $encodes));
    }

    /**
     *  在使用本方法前，必须初始化AopClient且传入公私钥参数。
     *  公钥是否是读取字符串还是读取文件，是根据初始化传入的值判断的。
     *
     * @param mixed $data
     * @param mixed $rsaPrivateKeyPem
     * @param mixed $charset
     *
     * @throws \SyException\Common\CheckException
     */
    public function rsaDecrypt($data, $rsaPrivateKeyPem, $charset): string
    {
        if ($this->checkEmpty($this->rsaPrivateKeyFilePath)) {
            //读字符串
            $priKey = $this->rsaPrivateKey;
            $res = "-----BEGIN RSA PRIVATE KEY-----\n"
                   . wordwrap($priKey, 64, "\n", true)
                   . "\n-----END RSA PRIVATE KEY-----";
        } else {
            $priKey = file_get_contents($this->rsaPrivateKeyFilePath);
            $res = openssl_get_privatekey($priKey);
        }
        if (!$res) {
            throw new CheckException('您使用的私钥格式错误,请检查RSA私钥配置', ErrorCode::COMMON_PARAM_ERROR);
        }
        //转换为openssl格式密钥
        $decodes = explode(',', $data);
        $strnull = '';
        $dcyCont = '';
        foreach ($decodes as $n => $decode) {
            if (!openssl_private_decrypt($decode, $dcyCont, $res)) {
                throw new CheckException(openssl_error_string(), ErrorCode::COMMON_PARAM_ERROR);
            }
            $strnull .= $dcyCont;
        }

        return $strnull;
    }

    public function splitCN($cont, $n, $subnum, $charset): array
    {
        $arrr = [];
        for ($i = $n; $i < \strlen($cont); $i += $subnum) {
            $res = $this->subCNchar($cont, $i, $subnum, $charset);
            if (!empty($res)) {
                $arrr[] = $res;
            }
        }

        return $arrr;
    }

    public function subCNchar($str, $start, $length, $charset = 'gbk')
    {
        if (\strlen($str) <= $length) {
            return $str;
        }
        $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);

        return implode('', \array_slice($match[0], $start, $length));
    }

    public function parserResponseSubCode($request, $responseContent, $respObject, $format)
    {
        if ('json' == $format) {
            $apiName = $request->getApiMethodName();
            $rootNodeName = str_replace('.', '_', $apiName) . $this->RESPONSE_SUFFIX;
            $errorNodeName = $this->ERROR_RESPONSE;

            $rootIndex = strpos($responseContent, $rootNodeName);
            $errorIndex = strpos($responseContent, $errorNodeName);

            if ($rootIndex > 0) {
                // 内部节点对象
                $rInnerObject = $respObject->{$rootNodeName};
            } elseif ($errorIndex > 0) {
                $rInnerObject = $respObject->{$errorNodeName};
            } else {
                return;
            }

            // 存在属性则返回对应值
            if (isset($rInnerObject->sub_code)) {
                return $rInnerObject->sub_code;
            }

            return;
        }
        if ('xml' == $format) {
            // xml格式sub_code在同一层级
            return $respObject->sub_code;
        }
    }

    public function parserJSONSignData($request, $responseContent, $responseJSON): SignData
    {
        $signData = new SignData();
        $signData->sign = $this->parserJSONSign($responseJSON);
        $signData->signSourceData = $this->parserJSONSignSource($request, $responseContent);

        return $signData;
    }

    public function parserJSONSignSource($request, $responseContent)
    {
        $apiName = $request->getApiMethodName();
        $rootNodeName = str_replace('.', '_', $apiName) . $this->RESPONSE_SUFFIX;

        $rootIndex = strpos($responseContent, $rootNodeName);
        $errorIndex = strpos($responseContent, $this->ERROR_RESPONSE);

        if ($rootIndex > 0) {
            return $this->parserJSONSource($responseContent, $rootNodeName, $rootIndex);
        }
        if ($errorIndex > 0) {
            return $this->parserJSONSource($responseContent, $this->ERROR_RESPONSE, $errorIndex);
        }
    }

    public function parserJSONSource($responseContent, $nodeName, $nodeIndex)
    {
        $signDataStartIndex = $nodeIndex + \strlen($nodeName) + 2;
        $signIndex = strrpos($responseContent, '"' . $this->SIGN_NODE_NAME . '"');
        // 签名前-逗号
        $signDataEndIndex = $signIndex - 1;
        $indexLen = $signDataEndIndex - $signDataStartIndex;
        if ($indexLen < 0) {
            return;
        }

        return substr($responseContent, $signDataStartIndex, $indexLen);
    }

    public function parserJSONSign($responseJSon)
    {
        return $responseJSon->sign;
    }

    public function parserXMLSignData($request, $responseContent): SignData
    {
        $signData = new SignData();
        $signData->sign = $this->parserXMLSign($responseContent);
        $signData->signSourceData = $this->parserXMLSignSource($request, $responseContent);

        return $signData;
    }

    public function parserXMLSignSource($request, $responseContent)
    {
        $apiName = $request->getApiMethodName();
        $rootNodeName = str_replace('.', '_', $apiName) . $this->RESPONSE_SUFFIX;

        $rootIndex = strpos($responseContent, $rootNodeName);
        $errorIndex = strpos($responseContent, $this->ERROR_RESPONSE);

        if ($rootIndex > 0) {
            return $this->parserXMLSource($responseContent, $rootNodeName, $rootIndex);
        }
        if ($errorIndex > 0) {
            return $this->parserXMLSource($responseContent, $this->ERROR_RESPONSE, $errorIndex);
        }
    }

    public function parserXMLSource($responseContent, $nodeName, $nodeIndex)
    {
        $signDataStartIndex = $nodeIndex + \strlen($nodeName) + 1;
        $signIndex = strrpos($responseContent, '<' . $this->SIGN_NODE_NAME . '>');
        // 签名前-逗号
        $signDataEndIndex = $signIndex - 1;
        $indexLen = $signDataEndIndex - $signDataStartIndex + 1;

        if ($indexLen < 0) {
            return;
        }

        return substr($responseContent, $signDataStartIndex, $indexLen);
    }

    public function parserXMLSign($responseContent)
    {
        $signNodeName = '<' . $this->SIGN_NODE_NAME . '>';
        $signEndNodeName = '</' . $this->SIGN_NODE_NAME . '>';

        $indexOfSignNode = strpos($responseContent, $signNodeName);
        $indexOfSignEndNode = strpos($responseContent, $signEndNodeName);

        if ($indexOfSignNode < 0 || $indexOfSignEndNode < 0) {
            return;
        }

        $nodeIndex = ($indexOfSignNode + \strlen($signNodeName));

        $indexLen = $indexOfSignEndNode - $nodeIndex;

        if ($indexLen < 0) {
            return;
        }

        // 签名
        return substr($responseContent, $nodeIndex, $indexLen);
    }

    /**
     * 验签
     *
     * @param $request
     * @param $signData
     * @param $resp
     * @param $respObject
     *
     * @throws \Exception
     */
    public function checkResponseSign($request, $signData, $resp, $respObject)
    {
        if (!$this->checkEmpty($this->alipayPublicKey) || !$this->checkEmpty($this->alipayrsaPublicKey)) {
            if (null === $signData
                || $this->checkEmpty($signData->sign) || $this->checkEmpty($signData->signSourceData)) {
                throw new \Exception(' check sign Fail! The reason : signData is Empty');
            }

            // 获取结果sub_code
            $responseSubCode = $this->parserResponseSubCode($request, $resp, $respObject, $this->format);

            if (!$this->checkEmpty($responseSubCode)
                || ($this->checkEmpty($responseSubCode) && !$this->checkEmpty($signData->sign))) {
                if (!$this->verify(
                    $signData->signSourceData,
                    $signData->sign,
                    $this->alipayPublicKey,
                    $this->signType
                )) {
                    if (strpos($signData->signSourceData, '\\/') > 0) {
                        $signData->signSourceData = str_replace('\\/', '/', $signData->signSourceData);
                        if (!$this->verify(
                            $signData->signSourceData,
                            $signData->sign,
                            $this->alipayPublicKey,
                            $this->signType
                        )) {
                            $errMsg = 'check sign Fail! [sign=' . $signData->sign
                                      . ', signSourceData=' . $signData->signSourceData
                                      . ']';

                            throw new \Exception($errMsg);
                        }
                    } else {
                        $errMsg = 'check sign Fail! [sign=' . $signData->sign
                                  . ', signSourceData=' . $signData->signSourceData
                                  . ']';

                        throw new \Exception($errMsg);
                    }
                }
            }
        }
    }

    public function echoDebug($content)
    {
        if ($this->debugInfo) {
            echo '<br/>' . $content;
        }
    }

    protected function sign($data, $signType = 'RSA')
    {
        if ($this->checkEmpty($this->rsaPrivateKeyFilePath)) {
            $priKey = $this->rsaPrivateKey;
            $res = "-----BEGIN RSA PRIVATE KEY-----\n"
                   . wordwrap($priKey, 64, "\n", true)
                   . "\n-----END RSA PRIVATE KEY-----";
        } else {
            $priKey = file_get_contents($this->rsaPrivateKeyFilePath);
            $res = openssl_get_privatekey($priKey);
        }

        ($res) || die('您使用的私钥格式错误，请检查RSA私钥配置');

        if ('RSA2' == $signType) {
            openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        } else {
            openssl_sign($data, $sign, $res);
        }

        if (!$this->checkEmpty($this->rsaPrivateKeyFilePath)) {
            openssl_free_key($res);
        }

        return base64_encode($sign);
    }

    /**
     * @throws \Exception
     *
     * @param mixed      $url
     * @param null|mixed $postFields
     */
    protected function curl($url, $postFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $postBodyString = '';
        $encodeArray = [];
        $postMultipart = false;

        if (\is_array($postFields) && 0 < \count($postFields)) {
            foreach ($postFields as $k => $v) {
                if ('@' != substr($v, 0, 1)) { //判断是不是文件上传
                    $postBodyString .= "{$k}=" . urlencode($this->characet($v, $this->postCharset)) . '&';
                    $encodeArray[$k] = $this->characet($v, $this->postCharset);
                } else { //文件上传用multipart/form-data，否则用www-form-urlencoded
                    $postMultipart = true;
                    $encodeArray[$k] = new \CURLFile(substr($v, 1));
                }
            }
            unset($k, $v);
            curl_setopt($ch, CURLOPT_POST, true);
            if ($postMultipart) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $encodeArray);
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString, 0, -1));
            }
        }

        if (!$postMultipart) {
            $headers = ['content-type: application/x-www-form-urlencoded;charset=' . $this->postCharset];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
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

    protected function getMillisecond(): float
    {
        list($s1, $s2) = explode(' ', microtime());

        return (float)sprintf('%.0f', ((float)$s1 + (float)$s2) * 1000);
    }

    protected function logCommunicationError($apiName, $requestUrl, $errorCode, $responseTxt)
    {
        Log::info([
            date('Y-m-d H:i:s'),
            $apiName,
            $this->appId,
            PHP_OS,
            $this->alipaySdkVersion,
            $requestUrl,
            $errorCode,
            str_replace("\n", '', $responseTxt),
        ]);
    }

    /**
     * 建立请求，以表单HTML形式构造（默认）
     *
     * @param array $para_temp 请求参数数组
     *
     * @return string 提交表单HTML文本
     */
    protected function buildRequestForm(array $para_temp)
    {
        $sHtml = '<form id="alipaysubmit" name="alipaysubmit" action="' . $this->gatewayUrl
                 . '?charset=' . trim($this->postCharset)
                 . '" method="POST">';
        while (list($key, $val) = $this->fun_adm_each($para_temp)) {
            if (false === $this->checkEmpty($val)) {
                $val = str_replace('"', '&quot;', $val);
                $sHtml .= '<input type="hidden" name="' . $key . '" value="' . $val . '"/>';
            }
        }
        //submit按钮控件请不要含有name属性
        $sHtml .= '<input type="submit" value="ok" style="display:none;"></form>'
                  . '<script>document.forms["alipaysubmit"].submit();</script>';

        return $sHtml;
    }

    protected function fun_adm_each(&$array)
    {
        $res = [];
        $key = key($array);
        if (null !== $key) {
            next($array);
            $res[1] = $res['value'] = $array[$key];
            $res[0] = $res['key'] = $key;
        } else {
            $res = false;
        }

        return $res;
    }

    /**
     * 校验$value是否非空
     *  if not set ,return true;
     *    if is null , return true;
     *
     * @param mixed $value
     */
    protected function checkEmpty($value)
    {
        if (null === $value) {
            return true;
        }
        if ('' === trim($value)) {
            return true;
        }

        return false;
    }

    private function setupCharsets($request)
    {
        if ($this->checkEmpty($this->postCharset)) {
            $this->postCharset = 'UTF-8';
        }
        $str = preg_match('/[\x80-\xff]/', $this->appId) ? $this->appId : print_r($request, true);
        $this->fileCharset = 'UTF-8' == mb_detect_encoding($str, 'UTF-8, GBK') ? 'UTF-8' : 'GBK';
    }

    // 获取加密内容

    private function encryptJSONSignSource($request, $responseContent): string
    {
        $parseItem = $this->parserEncryptJSONSignSource($request, $responseContent);
        $needLength = \strlen($responseContent) + 1 - $parseItem->endIndex;
        $bodyIndexContent = substr($responseContent, 0, $parseItem->startIndex);
        $bodyEndContent = substr($responseContent, $parseItem->endIndex, $needLength);

        $bizContent = AopEncrypt::decrypt($parseItem->encryptContent, $this->encryptKey);

        return $bodyIndexContent . $bizContent . $bodyEndContent;
    }

    private function parserEncryptJSONSignSource($request, $responseContent): EncryptParseItem
    {
        $apiName = $request->getApiMethodName();
        $rootNodeName = str_replace('.', '_', $apiName) . $this->RESPONSE_SUFFIX;

        $rootIndex = strpos($responseContent, $rootNodeName);
        $errorIndex = strpos($responseContent, $this->ERROR_RESPONSE);
        if ($rootIndex > 0) {
            return $this->parserEncryptJSONItem($responseContent, $rootNodeName, $rootIndex);
        }
        if ($errorIndex > 0) {
            return $this->parserEncryptJSONItem($responseContent, $this->ERROR_RESPONSE, $errorIndex);
        }
    }

    private function parserEncryptJSONItem($responseContent, $nodeName, $nodeIndex): EncryptParseItem
    {
        $signDataStartIndex = $nodeIndex + \strlen($nodeName) + 2;
        $signIndex = strpos($responseContent, '"' . $this->SIGN_NODE_NAME . '"');
        // 签名前-逗号
        $signDataEndIndex = $signIndex - 1;
        if ($signDataEndIndex < 0) {
            $signDataEndIndex = \strlen($responseContent) - 1;
        }

        $indexLen = $signDataEndIndex - $signDataStartIndex;

        $encContent = substr($responseContent, $signDataStartIndex + 1, $indexLen - 2);

        $encryptParseItem = new EncryptParseItem();

        $encryptParseItem->encryptContent = $encContent;
        $encryptParseItem->startIndex = $signDataStartIndex;
        $encryptParseItem->endIndex = $signDataEndIndex;

        return $encryptParseItem;
    }

    // 获取加密内容
    private function encryptXMLSignSource($request, $responseContent): string
    {
        $parseItem = $this->parserEncryptXMLSignSource($request, $responseContent);
        $needLength = \strlen($responseContent) + 1 - $parseItem->endIndex;
        $bodyIndexContent = substr($responseContent, 0, $parseItem->startIndex);
        $bodyEndContent = substr($responseContent, $parseItem->endIndex, $needLength);
        $bizContent = AopEncrypt::decrypt($parseItem->encryptContent, $this->encryptKey);

        return $bodyIndexContent . $bizContent . $bodyEndContent;
    }

    private function parserEncryptXMLSignSource($request, $responseContent): EncryptParseItem
    {
        $apiName = $request->getApiMethodName();
        $rootNodeName = str_replace('.', '_', $apiName) . $this->RESPONSE_SUFFIX;

        $rootIndex = strpos($responseContent, $rootNodeName);
        $errorIndex = strpos($responseContent, $this->ERROR_RESPONSE);

        if ($rootIndex > 0) {
            return $this->parserEncryptXMLItem($responseContent, $rootNodeName, $rootIndex);
        }
        if ($errorIndex > 0) {
            return $this->parserEncryptXMLItem($responseContent, $this->ERROR_RESPONSE, $errorIndex);
        }
    }

    private function parserEncryptXMLItem($responseContent, $nodeName, $nodeIndex): EncryptParseItem
    {
        $signDataStartIndex = $nodeIndex + \strlen($nodeName) + 1;

        $xmlStartNode = '<' . $this->ENCRYPT_XML_NODE_NAME . '>';
        $xmlEndNode = '</' . $this->ENCRYPT_XML_NODE_NAME . '>';

        $indexOfXmlNode = strpos($responseContent, $xmlEndNode);
        if ($indexOfXmlNode < 0) {
            $item = new EncryptParseItem();
            $item->encryptContent = null;
            $item->startIndex = 0;
            $item->endIndex = 0;

            return $item;
        }

        $startIndex = $signDataStartIndex + \strlen($xmlStartNode);
        $bizContentLen = $indexOfXmlNode - $startIndex;
        $bizContent = substr($responseContent, $startIndex, $bizContentLen);

        $encryptParseItem = new EncryptParseItem();
        $encryptParseItem->encryptContent = $bizContent;
        $encryptParseItem->startIndex = $signDataStartIndex;
        $encryptParseItem->endIndex = $indexOfXmlNode + \strlen($xmlEndNode);

        return $encryptParseItem;
    }
}
