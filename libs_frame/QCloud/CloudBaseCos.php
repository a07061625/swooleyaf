<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 19:28
 */
namespace QCloud;

use Constant\ErrorCode;
use DesignPatterns\Singletons\QCloudConfigSingleton;
use Exception\QCloud\CosException;

abstract class CloudBaseCos extends CloudBase {
    const REQ_METHOD_GET = 'GET'; //请求方式-GET
    const REQ_METHOD_POST = 'POST'; //请求方式-POST
    const REQ_METHOD_PUT = 'PUT'; //请求方式-PUT
    const REQ_METHOD_DELETE = 'DELETE'; //请求方式-DELETE
    const REQ_METHOD_HEAD = 'HEAD'; //请求方式-HEAD
    const REQ_METHOD_OPTIONS = 'OPTIONS'; //请求方式-OPTIONS

    public static $totalReqMethods = [
        self::REQ_METHOD_GET => ErrorCode::QCLOUD_COS_GET_ERROR,
        self::REQ_METHOD_POST => ErrorCode::QCLOUD_COS_POST_ERROR,
        self::REQ_METHOD_PUT => ErrorCode::QCLOUD_COS_PUT_ERROR,
        self::REQ_METHOD_DELETE => ErrorCode::QCLOUD_COS_DELETE_ERROR,
        self::REQ_METHOD_HEAD => ErrorCode::QCLOUD_COS_HEAD_ERROR,
        self::REQ_METHOD_OPTIONS => ErrorCode::QCLOUD_COS_OPTIONS_ERROR,
    ];

    /**
     * 请求参数字符串
     * @var string
     */
    private $reqQuery = '';
    /**
     * 签名标识 true:生成签名 false:不生成签名
     * @var bool
     */
    protected $signTag = true;
    /**
     * 请求方式(大写)
     * @var string
     */
    protected $reqMethod = '';
    /**
     * 请求域名
     * @var string
     */
    protected $reqHost = '';
    /**
     * 请求uri
     * @var string
     */
    protected $reqUri = '';
    /**
     * 参与签名的请求参数列表
     * @var array
     */
    protected $signParams = [];
    /**
     * 参与签名的请求头列表
     * @var array
     */
    protected $signHeaders = [];
    /**
     * 签名有效时间,单位为秒
     * @var int
     */
    protected $signExpireTime = 0;

    public function __construct(){
        parent::__construct();
        $this->reqUri = '/';
        $this->signTag = true;
        $this->signExpireTime = 30;
        $this->curlConfigs[CURLOPT_RETURNTRANSFER] = true;
    }

    private function __clone(){
    }

    /**
     * @param array $urlParams
     */
    protected function setReqQuery(array $urlParams){
        $this->reqQuery = http_build_query($urlParams);
    }

    /**
     * @param string $reqHost
     */
    protected function setReqHost(string $reqHost=''){
        if(strlen($reqHost) == 0){
            $this->reqHost = QCloudConfigSingleton::getInstance()->getCosConfig()->getReqHost();
        } else {
            $this->reqHost = $reqHost;
        }

        $this->reqHeader['Host'] = $this->reqHost;
        $this->signHeaders = [
            'host' => $this->reqHost,
        ];
    }

    /**
     * @param string $reqMethod
     * @throws \Exception\QCloud\CosException
     */
    protected function setReqMethod(string $reqMethod){
        if(isset(self::$totalReqMethods[$reqMethod])){
            $this->reqMethod = strtolower($reqMethod);
            $this->curlConfigs[CURLOPT_CUSTOMREQUEST] = $reqMethod;
        } else {
            throw new CosException('请求方式不支持', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getReqMethod() : string {
        return $this->reqMethod;
    }

    /**
     * @param int $signExpireTime
     * @throws \Exception\QCloud\CosException
     */
    protected function setSignExpireTime(int $signExpireTime){
        if($signExpireTime > 0){
            $this->signExpireTime = $signExpireTime;
        } else {
            throw new CosException('签名有效时间不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    protected function getContent() : array {
        if(!isset($this->reqMethod{0})){
            throw new CosException('请求方式不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        if(!isset($this->reqUri{0})){
            throw new CosException('请求uri不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        if(empty($this->signHeaders)){
            throw new CosException('签名请求头不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        if($this->signTag){
            CloudUtilCos::createSign([
                'expire_time' => $this->signExpireTime,
                'header_list' => $this->signHeaders,
                'param_list' => $this->signParams,
                'http_method' => $this->reqMethod,
                'http_uri' => $this->reqUri,
            ], $this->reqHeader);
        }

        $url = 'http://' . $this->reqHost . $this->reqUri;
        if(strlen($this->reqQuery) > 0){
            if(strpos($url, '?') === false){
                $url .= '?';
            } else {
                $url .= '&';
            }
            $url .= $this->reqQuery;
        }
        $this->curlConfigs[CURLOPT_URL] = $url;

        $reqHeaderArr = [];
        foreach ($this->reqHeader as $headerKey => $headerVal) {
            $reqHeaderArr[] = $headerKey . ': ' . $headerVal;
        }
        $this->curlConfigs[CURLOPT_HTTPHEADER] = $reqHeaderArr;
        return $this->curlConfigs;
    }
}