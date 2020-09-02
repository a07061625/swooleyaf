<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/2 0002
 * Time: 10:38
 */
namespace SyCloud\Ali;

use SyConstant\ErrorCode;
use SyException\Cloud\AliException;

/**
 * Trait ConfigTrait
 * @package SyCloud\Ali
 */
trait ConfigTrait
{
    /**
     * 访问ID
     * @var string
     */
    private $accessKey = '';
    /**
     * 访问密钥
     * @var string
     */
    private $accessSecret = '';

    /**
     * @return string
     */
    public function getAccessKey() : string
    {
        return $this->accessKey;
    }

    /**
     * @param string $accessKey
     * @throws \SyException\Cloud\AliException
     */
    public function setAccessKey(string $accessKey)
    {
        if (ctype_alnum($accessKey)) {
            $this->accessKey = $accessKey;
        } else {
            throw new AliException('访问ID不合法', ErrorCode::CLOUD_ALI_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAccessSecret() : string
    {
        return $this->accessSecret;
    }

    /**
     * @param string $accessSecret
     * @throws \SyException\Cloud\AliException
     */
    public function setAccessSecret(string $accessSecret)
    {
        if (ctype_alnum($accessSecret)) {
            $this->accessSecret = $accessSecret;
        } else {
            throw new AliException('访问密钥不合法', ErrorCode::CLOUD_ALI_ERROR);
        }
    }
}
