<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/11/21 0021
 * Time: 17:55
 */
namespace QiNiu;

use SyConstant\ErrorCode;
use SyException\QiNiu\KodoException;

class ConfigKodo
{
    /**
     * 访问账号
     * @var string
     */
    private $accessKey = '';
    /**
     * 密钥
     * @var string
     */
    private $secretKey = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getAccessKey() : string
    {
        return $this->accessKey;
    }

    /**
     * @param string $accessKey
     * @throws \SyException\QiNiu\KodoException
     */
    public function setAccessKey(string $accessKey)
    {
        if (ctype_alnum($accessKey)) {
            $this->accessKey = $accessKey;
        } else {
            throw new KodoException('访问账号不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
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
     * @throws \SyException\QiNiu\KodoException
     */
    public function setSecretKey(string $secretKey)
    {
        if (ctype_alnum($secretKey)) {
            $this->secretKey = $secretKey;
        } else {
            throw new KodoException('密钥不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }
}
