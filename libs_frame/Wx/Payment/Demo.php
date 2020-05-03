<?php
namespace Wx\Payment;

class Demo
{
    //注意事项:
    //1. 支付通知需要根据通知header里面的证书序号获取证书
    //2. 合单支付同一个子单不允许在不同的父单支付

    /**
     * 获取API v3证书
     * @return mixed
     */
    public function getCert()
    {
        $url = 'https://api.mch.weixin.qq.com/v3/certificates';

        $timestamp = time();
        $nonce = $this->nonce_str();
        $body = '';
        $sign = $this->sign($url, 'GET', $timestamp, $nonce, $body, $this->getPrivateKey($this->private_key), $this->mch_id,
            $this->serial_no);

        $header = [
            'Authorization: WECHATPAY2-SHA256-RSA2048 ' . $sign,
            'Accept:application/json',
            'User-Agent:' . $this->mch_id,
        ];

        $result = $this->curl($url, '', $header, 'GET');
        $result = json_decode($result, true);

        return $result['data']['0']['serial_no'];
    }

    /**
     * 支付请求
     * @return bool|mixed
     */
    public function pay()
    {
        $url = 'https://api.mch.weixin.qq.com/v3/combine-transactions/app';

        $requestData = [
            'combine_appid' => $this->app_id,
            'combine_mchid' => $this->mch_id,
            'combine_out_trade_no' => 'app_pay_' . time(),
            'scene_info' => [
                'device_id' => 'pay_device_id',
                'payer_client_ip' => '127.0.0.1',
            ],
            'time_start' => date('c', time()),
            'time_expire' => date('c', time() + 7200),
            'notify_url' => 'http://www.ttglad.com/notify.php',
            'sub_orders' => [
                [
                    'mchid' => $this->mch_id,
                    'attach' => 'notify with attach',
                    'amount' => [
                        'total_amount' => 100,
                        'currency' => 'CNY',
                    ],
                    'out_trade_no' => 'sub_order_' . time(),
                    'sub_mchid' => $this->sub_mch_id, // 二级商户号 需要进件系统生成
                    'profit_sharing' => true, // 分账
                    'description' => '描述',
                ],
            ],
        ];

        $header = $this->getCurlHeader($url, json_encode($requestData), 'POST');

        $result = $this->curl($url, json_encode($requestData), $header, 'POST');

        return json_decode($result, true);
    }

    /**
     * 支付查询
     * @return mixed
     */
    public function payQuery()
    {
        $url = 'https://api.mch.weixin.qq.com/v3/combine-transactions/out-trade-no/';
        $url = $url . ''; // 支付单号

        $method = 'GET';
        $data = '';
        $header = $this->getCurlHeader($url, $data, $method);

        $result = $this->curl($url, $data, $header, $method);

        return json_decode($result, true);
    }

    /**
     * 退款
     * @return mixed
     */
    public function refund()
    {
        $requestData = [
            'sp_appid' => $this->app_id,
            'sub_mchid' => $this->sub_mch_id,
            'transaction_id' => '',// 支付三方流水
            'out_refund_no' => '',// 退款单号

            'notify_url' => 'http://www.ttglad.com/notify_refund.php',
            'amount' => [
                'refund' => 100,
                'total' => 100,
                'currency' => 'CNY',
            ]
        ];

        $header = $this->getCurlHeader($this->refundUrl, json_encode($requestData), 'POST');
        $result = $this->curl($this->refundUrl, json_encode($requestData), $header, 'POST');

        return json_decode($result, true);
    }

    /**
     * 退款查询
     * @return mixed
     */
    public function refundQuery()
    {
        $url = 'https://api.mch.weixin.qq.com/v3/ecommerce/refunds/id/' . '' . '?sub_mchid=' . $this->sub_mch_id;

        $method = 'GET';
        $data = '';
        $header = $this->getCurlHeader($url, $data, $method);

        $result = $this->curl($url, $data, $header, $method);

        return json_decode($result, true);
    }

    /**
     * 支付通知
     */
    public function notify()
    {
        $header = $this->getHeaders();
        $body = $GLOBALS['HTTP_RAW_POST_DATA'];

        if (empty($header) || empty($body)) {
            throw new Exception('通知参数为空', 2001);
        }

        $timestamp = $header['WECHATPAY-TIMESTAMP'];
        $nonce = $header['WECHATPAY-NONCE'];
        $signature = $header['WECHATPAY-SIGNATURE'];
        $serialNo = $header['WECHATPAY-SERIAL'];
        if (empty($timestamp) || empty($nonce) || empty($signature) || empty($serialNo)) {
            throw new Exception('通知头参数为空', 2002);
        }

        $cert = $this->getCertBySerialNo($serialNo);

        $message = "$timestamp\n$nonce\n$body\n";

        //校验签名
        if (!$this->verify($message, $signature, $cert['plainCertificate'])) {
            throw new Exception('验签失败', 2005);
        }

        $decodeBody = json_decode($body, true);
        if (empty($decodeBody) || !isset($decodeBody['resource'])) {
            throw new Exception('通知参数内容为空', 2003);
        }
        $decodeBodyResource = $decodeBody['resource'];
        $decodeData = $this->decryptToString($decodeBodyResource['associated_data'], $decodeBodyResource['nonce'],
            $decodeBodyResource['ciphertext'], '');

        $decodeData = json_decode($decodeData, true);
        if (empty($decodeData)) {
            throw new Exception('通知参数解密发生错误', 2004);
        }

        // todo 业务逻辑
    }

    /**
     * 初始化参数
     */
    public function __construct()
    {
        parent::__construct();

        // 微信支付 商户号
        $this->mch_id = '';
        // 二级商户号，需要走进件系统生成
        $this->sub_mch_id = '';
        // 微信支付 商户号绑定的appid
        $this->app_id = '';

        // 商户私钥
        $this->private_key = '';

        // 商户证书序列号
        // 如何查看证书序列号：https://wechatpay-api.gitbook.io/wechatpay-api-v3/chang-jian-wen-ti/zheng-shu-xiang-guan#ru-he-cha-kan-zheng-shu-xu-lie-hao
        $this->serial_no = '';

        // apiv3秘钥：https://wechatpay-api.gitbook.io/wechatpay-api-v3/ren-zheng/api-v3-mi-yao
        $this->mch_key = '';
    }

    /**
     * @param $serialNo
     * @return mixed
     */
    private function getCertBySerialNo($serialNo)
    {
        $url = 'https://api.mch.weixin.qq.com/v3/certificates';

        $timestamp = time();
        $nonce = $this->nonce_str();
        $body = '';
        $sign = $this->sign($url, 'GET', $timestamp, $nonce, $body, $this->getPrivateKey($this->private_key), $this->mch_id,
            $this->serial_no);

        $header = [
            'Authorization: WECHATPAY2-SHA256-RSA2048 ' . $sign,
            'Accept:application/json',
            'User-Agent:' . $this->mch_id,
        ];

        $result = $this->curl($url, '', $header, 'GET');
        $cert = json_decode($result, true);

        $return = [];
        if (!empty($cert['data'])) {
            foreach ($cert['data'] as $item) {
                if ($serialNo == $item['serialNo']) {
                    $return = $item;
                    break;
                }
            }
        }

        return $return;
    }

    /**
     * @param $url
     * @param $body
     * @param $method
     * @return array
     */
    protected function getCurlHeader($url, $body, $method)
    {
        $timestamp = time();
        $nonce = $this->nonce_str();
        $sign = $this->sign($url, $method, $timestamp, $nonce, $body, $this->getPrivateKey($this->private_key), $this->mch_id,
            $this->serial_no);

        return [
            'Authorization: WECHATPAY2-SHA256-RSA2048 ' . $sign,
            'Accept:application/json',
            'User-Agent:' . $this->mch_id,
            'Content-Type:application/json',
            'Wechatpay-Serial:' . $this->getCert(),
        ];
    }

    /**
     * @return string
     */
    protected function nonce_str()
    {
        static $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 32; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param $key
     * @return bool|resource
     */
    protected function getPrivateKey($key)
    {
        return openssl_get_privatekey($key);
    }

    /**
     * @param $key
     * @return resource
     */
    protected function getPublicKey($key)
    {
        return openssl_get_publickey($key);
    }

    /**
     * @param $url
     * @param $http_method
     * @param $timestamp
     * @param $nonce
     * @param $body
     * @param $mch_private_key
     * @param $merchant_id
     * @param $serial_no
     * @return string
     */
    protected function sign($url, $http_method, $timestamp, $nonce, $body, $mch_private_key, $merchant_id, $serial_no)
    {
        $url_parts = parse_url($url);
        $canonical_url = ($url_parts['path'] . (!empty($url_parts['query']) ? "?${url_parts['query']}" : ""));

        $message = $http_method . "\n" .
            $canonical_url . "\n" .
            $timestamp . "\n" .
            $nonce . "\n" .
            $body . "\n";

        openssl_sign($message, $raw_sign, $mch_private_key, 'sha256WithRSAEncryption');
        $sign = base64_encode($raw_sign);

        $schema = 'WECHATPAY2-SHA256-RSA2048 ';
        $token = sprintf('mchid="%s",nonce_str="%s",timestamp="%d",serial_no="%s",signature="%s"',
            $merchant_id, $nonce, $timestamp, $serial_no, $sign);

        return $token;
    }

    /**
     * @param $message
     * @param $signature
     * @param $merchantPublicKey
     * @return bool|int
     */
    private function verify($message, $signature, $merchantPublicKey)
    {
        if (empty($merchantPublicKey)) {
            return false;
        }

        if (!in_array('sha256WithRSAEncryption', \openssl_get_md_methods(true))) {
            throw new \RuntimeException("当前PHP环境不支持SHA256withRSA");
        }
        $signature = base64_decode($signature);
        return openssl_verify($message, $signature, $this->getPublicKey($merchantPublicKey), 'sha256WithRSAEncryption');
    }

    /**
     * @param $url
     * @param array $data
     * @param $header
     * @param string $method
     * @param int $time_out
     * @return mixed
     */
    private function curl($url, $data = [], $header, $method = 'POST', $time_out = 3)
    {
        $curl = curl_init();
        // 设置curl允许执行的最长秒数

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, $time_out);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        if ($method == 'POST') {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        // 执行操作
        $result = curl_exec($curl);

        curl_close($curl);
        return $result;
    }

    /**
     * @param $associatedData
     * @param $nonceStr
     * @param $ciphertext
     * @param $aesKey
     * @return bool|string
     */
    private function decryptToString($associatedData, $nonceStr, $ciphertext, $aesKey = '')
    {
        if (empty($aesKey)) {
            $aesKey = $this->mch_key;
        }
        $ciphertext = \base64_decode($ciphertext);
        if (strlen($ciphertext) <= self::AUTH_TAG_LENGTH_BYTE) {
            return false;
        }

        // ext-sodium (default installed on >= PHP 7.2)
        if (function_exists('\sodium_crypto_aead_aes256gcm_is_available') &&
            \sodium_crypto_aead_aes256gcm_is_available()) {
            return \sodium_crypto_aead_aes256gcm_decrypt($ciphertext, $associatedData, $nonceStr, $aesKey);
        }

        // ext-libsodium (need install libsodium-php 1.x via pecl)
        if (function_exists('\Sodium\crypto_aead_aes256gcm_is_available') &&
            \Sodium\crypto_aead_aes256gcm_is_available()) {
            return \Sodium\crypto_aead_aes256gcm_decrypt($ciphertext, $associatedData, $nonceStr, $aesKey);
        }

        // openssl (PHP >= 7.1 support AEAD)
        if (PHP_VERSION_ID >= 70100 && in_array('aes-256-gcm', \openssl_get_cipher_methods())) {
            $ctext = substr($ciphertext, 0, -self::AUTH_TAG_LENGTH_BYTE);
            $authTag = substr($ciphertext, -self::AUTH_TAG_LENGTH_BYTE);

            return \openssl_decrypt($ctext, 'aes-256-gcm', $aesKey, \OPENSSL_RAW_DATA, $nonceStr,
                $authTag, $associatedData);
        }

        throw new \RuntimeException('AEAD_AES_256_GCM需要PHP 7.1以上或者安装libsodium-php');
    }

    /**
     * @return array
     */
    private function getHeaders()
    {
        $headers = array();
        foreach ($_SERVER as $key => $value) {
            if ('HTTP_' == substr($key, 0, 5)) {
                $headers[str_replace('_', '-', substr($key, 5))] = $value;
            }
            if (isset($_SERVER['PHP_AUTH_DIGEST'])) {
                $header['AUTHORIZATION'] = $_SERVER['PHP_AUTH_DIGEST'];
            } elseif (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
                $header['AUTHORIZATION'] = base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $_SERVER['PHP_AUTH_PW']);
            }
            if (isset($_SERVER['CONTENT_LENGTH'])) {
                $header['CONTENT-LENGTH'] = $_SERVER['CONTENT_LENGTH'];
            }
            if (isset($_SERVER['CONTENT_TYPE'])) {
                $header['CONTENT-TYPE'] = $_SERVER['CONTENT_TYPE'];
            }
        }
        return $headers;
    }
}
