<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/18 0018
 * Time: 16:26
 */
namespace SyLogistics;

use SyConstant\ErrorCode;
use SyException\Logistics\AliMarketAliException;

class ConfigAliMarketAli
{
    /**
     * APP KEY
     * @var string
     */
    private $appKey = '';
    /**
     * APP 密钥
     * @var string
     */
    private $appSecret = '';
    /**
     * APP 编码
     * @var string
     */
    private $appCode = '';
    /**
     * 服务协议
     * @var string
     */
    private $serviceProtocol = '';
    /**
     * 服务域名
     * @var string
     */
    private $serviceDomain = '';
    /**
     * 服务地址
     * @var string
     */
    private $serviceAddress = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getAppKey() : string
    {
        return $this->appKey;
    }

    /**
     * @param string $appKey
     * @throws \SyException\Logistics\AliMarketAliException
     */
    public function setAppKey(string $appKey)
    {
        if (ctype_alnum($appKey)) {
            $this->appKey = $appKey;
        } else {
            throw new AliMarketAliException('app key不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAppSecret() : string
    {
        return $this->appSecret;
    }

    /**
     * @param string $appSecret
     * @throws \SyException\Logistics\AliMarketAliException
     */
    public function setAppSecret(string $appSecret)
    {
        if (ctype_alnum($appSecret)) {
            $this->appSecret = $appSecret;
        } else {
            throw new AliMarketAliException('app 密钥不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAppCode() : string
    {
        return $this->appCode;
    }

    /**
     * @param string $appCode
     * @throws \SyException\Logistics\AliMarketAliException
     */
    public function setAppCode(string $appCode)
    {
        if (ctype_alnum($appCode)) {
            $this->appCode = $appCode;
        } else {
            throw new AliMarketAliException('app 编码不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getServiceProtocol() : string
    {
        return $this->serviceProtocol;
    }

    /**
     * @return string
     */
    public function getServiceDomain() : string
    {
        return $this->serviceDomain;
    }

    /**
     * @return string
     */
    public function getServiceAddress() : string
    {
        return $this->serviceAddress;
    }

    /**
     * @param string $protocol
     * @param string $domain
     * @throws \SyException\Logistics\AliMarketAliException
     */
    public function setServiceAddress(string $protocol, string $domain)
    {
        if (!in_array($protocol, ['http', 'https'])) {
            throw new AliMarketAliException('服务协议不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        $trueDomain = trim($domain);
        if (strlen($trueDomain) == 0) {
            throw new AliMarketAliException('服务域名不合法', ErrorCode::LOGISTICS_PARAM_ERROR);
        }
        $this->serviceProtocol = $protocol;
        $this->serviceDomain = $trueDomain;
        $this->serviceAddress = $protocol . '://' . $trueDomain;
    }
}
