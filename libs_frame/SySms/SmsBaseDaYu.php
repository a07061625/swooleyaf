<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/7 0007
 * Time: 9:42
 */
namespace SySms;

abstract class SmsBaseDaYu extends SmsBase {
    /**
     * API接口名称
     * @var string
     */
    private $method = '';
    /**
     * 签名的摘要算法
     * @var string
     */
    private $signMethod = '';
    /**
     * 响应格式
     * @var string
     */
    private $format = '';
    /**
     * API协议版本
     * @var string
     */
    private $version = '';
    /**
     * 时间戳
     * @var string
     */
    private $timestamp = '';
    /**
     * 响应标识
     * @var string
     */
    private $responseTag = '';
    /**
     * 应用标识
     * @var string
     */
    protected $appKey = '';
    /**
     * 应用密钥
     * @var string
     */
    protected $appSecret = '';

    public function __construct(){
        $this->signMethod = 'md5';
        $this->format = 'json';
        $this->version = '2.0';
        $this->timestamp = date('Y-m-d H:i:s');
    }

    private function __clone(){
    }

    /**
     * @param string $method
     */
    protected function setMethod(string $method) {
        $this->method = $method;
        $this->responseTag = str_replace('.', '_', $method) . '_response';
    }

    /**
     * @return string
     */
    public function getResponseTag() : string {
        return $this->responseTag;
    }

    protected function getContent() : array {
        $this->reqData['v'] = $this->version;
        $this->reqData['app_key'] = $this->appKey;
        $this->reqData['sign_method'] = $this->signMethod;
        $this->reqData['format'] = $this->format;
        $this->reqData['method'] = $this->method;
        $this->reqData['timestamp'] = $this->timestamp;
        SmsUtilDaYu::createSign($this->reqData, $this->appSecret);

        return $this->reqData;
    }
}