<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/3/27 0027
 * Time: 19:01
 */
namespace SyLive;

use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;
use SyTrait\SimpleConfigTrait;

/**
 * Class ConfigBaiJia
 *
 * @package SyLive
 */
class ConfigBaiJia
{
    use SimpleConfigTrait;

    /**
     * 账号ID
     *
     * @var string
     */
    private $partnerId = '';
    /**
     * 账号密钥
     *
     * @var string
     */
    private $secretKey = '';
    /**
     * 个性域名
     *
     * @var string
     */
    private $privateDomain = '';
    /**
     * api域名
     *
     * @var string
     */
    private $apiDomain = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getPartnerId() : string
    {
        return $this->partnerId;
    }

    /**
     * @param string $partnerId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setPartnerId(string $partnerId)
    {
        if (ctype_alnum($partnerId)) {
            $this->partnerId = $partnerId;
        } else {
            throw new BaiJiaException('账号ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getSecretKey() : string
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     * @throws \SyException\Live\BaiJiaException
     */
    public function setSecretKey(string $secretKey)
    {
        if (ctype_alnum($secretKey)) {
            $this->secretKey = $secretKey;
        } else {
            throw new BaiJiaException('账号密钥不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getPrivateDomain() : string
    {
        return $this->privateDomain;
    }

    /**
     * @return string
     */
    public function getApiDomain() : string
    {
        return $this->apiDomain;
    }

    /**
     * @param string $privateDomain
     * @throws \SyException\Live\BaiJiaException
     */
    public function setPrivateDomain(string $privateDomain)
    {
        $trueDomain = trim($privateDomain);
        if (strlen($trueDomain) > 0) {
            $this->privateDomain = $trueDomain;
            $this->apiDomain = 'https://' . $trueDomain . '.at.baijiayun.com';
        } else {
            throw new BaiJiaException('个性域名不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }
}
