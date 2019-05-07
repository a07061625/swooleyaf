<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace QCloud\Cos;

use Constant\ErrorCode;
use Exception\QCloud\CosException;
use QCloud\CloudBaseCos;
use QCloud\CloudUtilCos;

/**
 * 对象上传
 * @package QCloud\Cos
 */
class ObjectPost extends CloudBaseCos
{
    /**
     * 权限策略
     * @var string
     */
    private $acl = '';
    /**
     * 文件全路径
     * @var string
     */
    private $filePath = '';
    /**
     * 上传后文件名
     * @var string
     */
    private $fileName = '';
    /**
     * 权限策略
     * @var string
     */
    private $policy = '';

    public function __construct()
    {
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_POST);
        $this->signTag = false;
        $this->reqData['acl'] = 'default';
    }

    private function __clone()
    {
    }

    /**
     * @param string $acl
     * @throws \Exception\QCloud\CosException
     */
    public function setAcl(string $acl)
    {
        if (in_array($acl, ['private', 'public-read', 'default',], true)) {
            $this->reqData['acl'] = $acl;
        } else {
            throw new CosException('权限策略不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
    }

    /**
     * @param string $filePath
     * @throws \Exception\QCloud\CosException
     */
    public function setFilePath(string $filePath)
    {
        if (is_file($filePath) && is_readable($filePath)) {
            $this->filePath = $filePath;
        } else {
            throw new CosException('文件路径不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
    }

    /**
     * @param string $fileName
     * @throws \Exception\QCloud\CosException
     */
    public function setFileName(string $fileName)
    {
        $trueName = trim($fileName);
        if (strlen($trueName) > 0) {
            $this->reqData['key'] = $trueName;
        } else {
            throw new CosException('文件名不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
    }

    /**
     * @param array $policyConfig
     */
    public function setPolicy(array $policyConfig)
    {
        CloudUtilCos::createPolicySign($policyConfig, $this->reqData);
    }

    /**
     * @param string $key
     * @param string $val
     * @throws \Exception\QCloud\CosException
     */
    public function addExtendRedData(string $key, string $val)
    {
        if (in_array($key, ['acl', 'file', 'key', 'policy',], true)) {
            throw new CosException('字段名不允许', ErrorCode::COMMON_PARAM_ERROR);
        }

        $this->reqData[$key] = $val;
    }

    public function getDetail() : array
    {
        if (strlen($this->filePath) == 0) {
            throw new CosException('文件路径不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }
        if (!isset($this->reqData['key'])) {
            throw new CosException('文件名不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }
        if (!isset($this->reqData['policy'])) {
            throw new CosException('权限策略不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }
        $this->reqData['file'] = new \CURLFile($this->filePath);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $this->reqData;

        return $this->getContent();
    }
}
