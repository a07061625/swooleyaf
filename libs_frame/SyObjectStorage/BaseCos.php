<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 19:28
 */
namespace SyObjectStorage;

use DesignPatterns\Singletons\ObjectStorageConfigSingleton;
use SyConstant\ErrorCode;
use SyException\ObjectStorage\CosException;

abstract class BaseCos extends Base
{
    const REQ_METHOD_GET = 'GET'; //请求方式-GET
    const REQ_METHOD_POST = 'POST'; //请求方式-POST
    const REQ_METHOD_PUT = 'PUT'; //请求方式-PUT
    const REQ_METHOD_DELETE = 'DELETE'; //请求方式-DELETE
    const REQ_METHOD_HEAD = 'HEAD'; //请求方式-HEAD
    const REQ_METHOD_OPTIONS = 'OPTIONS'; //请求方式-OPTIONS

    public static $totalReqMethods = [
        self::REQ_METHOD_GET => ErrorCode::OBJECT_STORAGE_COS_GET_ERROR,
        self::REQ_METHOD_POST => ErrorCode::OBJECT_STORAGE_COS_POST_ERROR,
        self::REQ_METHOD_PUT => ErrorCode::OBJECT_STORAGE_COS_PUT_ERROR,
        self::REQ_METHOD_DELETE => ErrorCode::OBJECT_STORAGE_COS_DELETE_ERROR,
        self::REQ_METHOD_HEAD => ErrorCode::OBJECT_STORAGE_COS_HEAD_ERROR,
        self::REQ_METHOD_OPTIONS => ErrorCode::OBJECT_STORAGE_COS_OPTIONS_ERROR,
    ];

    /**
     * 应用ID
     *
     * @var string
     */
    protected $appId = '';
    /**
     * 请求头
     *
     * @var array
     */
    protected $reqHeader = [];
    /**
     * 签名标识 true:生成签名 false:不生成签名
     *
     * @var bool
     */
    protected $signTag = true;
    /**
     * 请求方式(大写)
     *
     * @var string
     */
    protected $reqMethod = '';
    /**
     * 请求域名
     *
     * @var string
     */
    protected $reqHost = '';
    /**
     * 请求uri
     *
     * @var string
     */
    protected $reqUri = '';
    /**
     * 参与签名的请求参数列表
     *
     * @var array
     */
    protected $signParams = [];
    /**
     * 参与签名的请求头列表
     *
     * @var array
     */
    protected $signHeaders = [];
    /**
     * 签名有效时间,单位为秒
     *
     * @var int
     */
    protected $signExpireTime = 0;
    /**
     * 请求参数字符串
     *
     * @var string
     */
    private $reqQuery = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->appId = $appId;
        $this->reqUri = '/';
        $this->signTag = true;
        $this->signExpireTime = 30;
        $this->curlConfigs[CURLOPT_RETURNTRANSFER] = true;
    }

    private function __clone()
    {
    }

    /**
     * @param string $headerKey
     * @param string $headerVal
     */
    public function addReqHeader(string $headerKey, string $headerVal)
    {
        $trueHeaderKey = trim($headerKey);
        if (strlen($trueHeaderKey) > 0) {
            $this->reqHeader[$trueHeaderKey] = trim($headerVal);
        }
    }

    /**
     * @return string
     */
    public function getReqMethod() : string
    {
        return $this->reqMethod;
    }

    /**
     * @param array $urlParams
     */
    protected function setReqQuery(array $urlParams)
    {
        $this->reqQuery = http_build_query($urlParams);
    }

    /**
     * @param string $reqHost
     *
     * @throws \SyException\Cloud\TencentException
     * @throws \SyException\ObjectStorage\CosException
     */
    protected function setReqHost(string $reqHost = '')
    {
        if (strlen($reqHost) == 0) {
            $this->reqHost = ObjectStorageConfigSingleton::getInstance()->getCosConfig($this->appId)->getReqHost();
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
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    protected function setReqMethod(string $reqMethod)
    {
        if (isset(self::$totalReqMethods[$reqMethod])) {
            $this->reqMethod = strtolower($reqMethod);
            $this->curlConfigs[CURLOPT_CUSTOMREQUEST] = $reqMethod;
        } else {
            throw new CosException('请求方式不支持', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    /**
     * @param int $signExpireTime
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    protected function setSignExpireTime(int $signExpireTime)
    {
        if ($signExpireTime > 0) {
            $this->signExpireTime = $signExpireTime;
        } else {
            throw new CosException('签名有效时间不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    protected function getContent() : array
    {
        if (!isset($this->reqMethod[0])) {
            throw new CosException('请求方式不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        if (!isset($this->reqUri[0])) {
            throw new CosException('请求uri不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        if (empty($this->signHeaders)) {
            throw new CosException('签名请求头不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        if ($this->signTag) {
            UtilCos::createSign($this->appId, [
                'expire_time' => $this->signExpireTime,
                'header_list' => $this->signHeaders,
                'param_list' => $this->signParams,
                'http_method' => $this->reqMethod,
                'http_uri' => $this->reqUri,
            ], $this->reqHeader);
        }

        $url = 'http://' . $this->reqHost . $this->reqUri;
        if (strlen($this->reqQuery) > 0) {
            if (strpos($url, '?') === false) {
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
