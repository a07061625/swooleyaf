<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-9
 * Time: 下午12:39
 */

namespace SyMap;

use DesignPatterns\Singletons\MapSingleton;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Map\BaiduMapException;

abstract class MapBaseBaiDu extends MapBase
{
    const CHECK_TYPE_SERVER_IP = 'server-ip'; //校验类型-服务端ip
    const CHECK_TYPE_SERVER_SN = 'server-sn'; //校验类型-服务端签名
    const CHECK_TYPE_BROWSE = 'browse'; //校验类型-浏览器

    public $checkTypes = [
        self::CHECK_TYPE_SERVER_IP => 1,
        self::CHECK_TYPE_SERVER_SN => 1,
        self::CHECK_TYPE_BROWSE => 1,
    ];
    /**
     * 服务uri
     *
     * @var string
     */
    protected $serviceUri = '';

    /**
     * 应用密钥
     *
     * @var string
     */
    private $ak = '';
    /**
     * 服务端IP
     *
     * @var string
     */
    private $serverIp = '';
    /**
     * 输出格式
     *
     * @var string
     */
    private $output = '';
    /**
     * 服务域名
     *
     * @var string
     */
    private $serviceDomain = '';
    /**
     * 校验类型
     *
     * @var string
     */
    private $checkType = '';
    /**
     * 请求方式
     *
     * @var string
     */
    private $reqMethod = '';
    /**
     * 用户签名
     *
     * @var string
     */
    private $sk = '';
    /**
     * 请求引用地址
     *
     * @var string
     */
    private $reqReferer = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceDomain = 'http://api.map.baidu.com';
        $this->ak = MapSingleton::getInstance()->getBaiduConfig()->getAk();
        $this->serverIp = MapSingleton::getInstance()->getBaiduConfig()->getServerIp();
        $this->output = 'json';
        $this->checkType = self::CHECK_TYPE_SERVER_IP;
        $this->reqMethod = 'GET';
    }

    /**
     * @throws \SyException\Map\BaiduMapException
     */
    public function setCheckType(string $checkType)
    {
        if (isset($this->checkTypes[$checkType])) {
            $this->checkType = $checkType;
        } else {
            throw new BaiduMapException('校验类型不支持', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Map\BaiduMapException
     */
    public function setReqMethod(string $reqMethod)
    {
        if (\in_array($reqMethod, ['GET', 'POST'], true)) {
            $this->reqMethod = $reqMethod;
        } else {
            throw new BaiduMapException('请求方式不支持', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Map\BaiduMapException
     */
    public function setSk(string $sk)
    {
        if (ctype_alnum($sk) && (32 == \strlen($sk))) {
            $this->sk = $sk;
        } else {
            throw new BaiduMapException('用户签名不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Map\BaiduMapException
     */
    public function setReqReferer(string $reqReferer)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $reqReferer) > 0) {
            $this->reqReferer = $reqReferer;
        } else {
            throw new BaiduMapException('请求引用地址不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    protected function getServiceUrl()
    {
        return $this->serviceDomain . $this->serviceUri;
    }

    protected function getContent(): array
    {
        $this->reqData['ak'] = $this->ak;
        $this->reqData['output'] = $this->output;
        switch ($this->checkType) {
            case self::CHECK_TYPE_SERVER_IP:
                $this->curlConfigs[CURLOPT_HTTPHEADER] = [
                    'X-FORWARDED-FOR: ' . $this->serverIp,
                    'CLIENT-IP: ' . $this->serverIp,
                ];

                break;
            case self::CHECK_TYPE_SERVER_SN:
                if (0 == \strlen($this->sk)) {
                    throw new BaiduMapException('签名校验码不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
                }
                if ('POST' === $this->reqMethod) {
                    ksort($this->reqData);
                }

                $snStr = $this->serviceUri . '?' . http_build_query($this->reqData) . $this->sk;
                $this->reqData['sn'] = md5(urlencode($snStr));

                break;
            case self::CHECK_TYPE_BROWSE:
                if (0 == \strlen($this->reqReferer)) {
                    throw new BaiduMapException('请求引用地址不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
                }

                $this->curlConfigs[CURLOPT_REFERER] = $this->reqReferer;
                $this->curlConfigs[CURLOPT_USERAGENT] = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.57 Safari/536.11';

                break;
            default:
                break;
        }
        $this->curlConfigs[CURLOPT_URL] = $this->getServiceUrl() . '?' . http_build_query($this->reqData);

        return $this->curlConfigs;
    }
}
