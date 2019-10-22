<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-9
 * Time: 下午12:40
 */
namespace SyMap;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\MapSingleton;
use SyException\Map\TencentMapException;

abstract class MapBaseTencent extends MapBase
{
    const GET_TYPE_SERVER = 'server'; //获取类型-服务端
    const GET_TYPE_MOBILE = 'mobile'; //获取类型-移动端
    const GET_TYPE_BROWSE = 'browse'; //获取类型-网页端
    /**
     * 服务请求地址
     * @var string
     */
    protected $serviceUrl = '';

    /**
     * 返回格式,默认JSON
     * @var string
     */
    private $key = '';
    /**
     * 服务端IP
     * @var string
     */
    private $serverIp = '';
    /**
     * 页面URL
     * @var string
     */
    private $webUrl = '';
    /**
     * 手机应用标识符
     * @var string
     */
    private $appIdentifier = '';
    /**
     * 返回格式,默认JSON
     * @var string
     */
    private $output = '';
    /**
     * 获取类型
     * @var string
     */
    private $getType = '';

    public function __construct()
    {
        parent::__construct();
        $config = MapSingleton::getInstance()->getTencentConfig();
        $this->serverIp = $config->getServerIp();
        $this->webUrl = $config->getDomain();
        $this->getType = self::GET_TYPE_SERVER;
        $this->reqData['output'] = 'json';
        $this->reqData['key'] = $config->getKey();
    }

    /**
     * @param string $appIdentifier
     * @throws \SyException\Map\TencentMapException
     */
    public function setAppIdentifier(string $appIdentifier)
    {
        $identifier = trim($appIdentifier);
        if (strlen($identifier) > 0) {
            $this->appIdentifier = $identifier;
        } else {
            throw new TencentMapException('应用标识符不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $getType
     * @throws \SyException\Map\TencentMapException
     */
    public function setGetType(string $getType)
    {
        if (in_array($getType, [self::GET_TYPE_MOBILE, self::GET_TYPE_SERVER, self::GET_TYPE_BROWSE], true)) {
            $this->getType = $getType;
        } else {
            throw new TencentMapException('获取类型不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    protected function getContent() : array
    {
        switch ($this->getType) {
            case self::GET_TYPE_BROWSE:
                $this->curlConfigs[CURLOPT_REFERER] = $this->webUrl;
                $this->curlConfigs[CURLOPT_USERAGENT] = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.57 Safari/536.11';
                break;
            case self::GET_TYPE_SERVER:
                $this->curlConfigs[CURLOPT_HTTPHEADER] = [
                    'X-FORWARDED-FOR: ' . $this->serverIp,
                    'CLIENT-IP: ' . $this->serverIp,
                ];
                break;
            case self::GET_TYPE_MOBILE:
                if (strlen($this->appIdentifier) == 0) {
                    throw new TencentMapException('应用标识符不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
                }

                $this->curlConfigs[CURLOPT_REFERER] = $this->appIdentifier;
                break;
        }
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . http_build_query($this->reqData);
        return $this->curlConfigs;
    }
}
