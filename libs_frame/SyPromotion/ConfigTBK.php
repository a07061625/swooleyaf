<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 9:55
 */
namespace SyPromotion;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;

/**
 * Class ConfigTBK
 * @package SyPromotion
 */
class ConfigTBK
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
     * @throws \SyException\Promotion\TBKException
     */
    public function setAppKey(string $appKey)
    {
        if (ctype_alnum($appKey)) {
            $this->appKey = $appKey;
        } else {
            throw new TBKException('app key不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
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
     * @throws \SyException\Promotion\TBKException
     */
    public function setAppSecret(string $appSecret)
    {
        if (ctype_alnum($appSecret)) {
            $this->appSecret = $appSecret;
        } else {
            throw new TBKException('app secret不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }
}
