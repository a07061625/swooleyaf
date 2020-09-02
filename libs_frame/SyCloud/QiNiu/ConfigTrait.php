<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/2 0002
 * Time: 10:38
 */
namespace SyCloud\QiNiu;

use SyConstant\ErrorCode;
use SyException\Cloud\QiNiuException;

/**
 * Trait ConfigTrait
 *
 * @package SyCloud\QiNiu
 */
trait ConfigTrait
{
    /**
     * 访问账号
     *
     * @var string
     */
    private $accessKey = '';
    /**
     * 密钥
     *
     * @var string
     */
    private $secretKey = '';

    /**
     * @return string
     */
    public function getAccessKey() : string
    {
        return $this->accessKey;
    }

    /**
     * @param string $accessKey
     *
     * @throws \SyException\Cloud\QiNiuException
     */
    public function setAccessKey(string $accessKey)
    {
        if (ctype_alnum($accessKey)) {
            $this->accessKey = $accessKey;
        } else {
            throw new QiNiuException('访问账号不合法', ErrorCode::CLOUD_QINIU_ERROR);
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
     *
     * @throws \SyException\Cloud\QiNiuException
     */
    public function setSecretKey(string $secretKey)
    {
        if (ctype_alnum($secretKey)) {
            $this->secretKey = $secretKey;
        } else {
            throw new QiNiuException('密钥不合法', ErrorCode::CLOUD_QINIU_ERROR);
        }
    }
}
