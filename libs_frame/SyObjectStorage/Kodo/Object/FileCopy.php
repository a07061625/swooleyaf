<?php
/**
 * 资源复制
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 12:37
 */
namespace SyObjectStorage\Kodo\Object;

use SyCloud\QiNiu\Util;
use SyConstant\ErrorCode;
use SyException\ObjectStorage\KodoException;
use SyObjectStorage\BaseKodo;

class FileCopy extends BaseKodo
{
    /**
     * 源空间名称
     *
     * @var string
     */
    private $srcBucketName = '';
    /**
     * 源文件名称
     *
     * @var string
     */
    private $srcFileName = '';
    /**
     * 目标空间名称
     *
     * @var string
     */
    private $destBucketName = '';
    /**
     * 目标文件名称
     *
     * @var string
     */
    private $destFileName = '';
    /**
     * 强制覆盖标识
     *
     * @var bool
     */
    private $force = false;

    public function __construct(string $accessKey)
    {
        parent::__construct($accessKey);
        $this->setServiceHost('rs.qiniu.com');
        $this->reqHeader['Content-Type'] = 'application/x-www-form-urlencoded';
    }

    private function __clone()
    {
    }

    /**
     * @param string $srcBucketName
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setSrcBucketName(string $srcBucketName)
    {
        if (ctype_alnum($srcBucketName)) {
            $this->srcBucketName = $srcBucketName;
        } else {
            throw new KodoException('源空间名称不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $srcFileName
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setSrcFileName(string $srcFileName)
    {
        if (strlen($srcFileName) > 0) {
            $this->srcFileName = $srcFileName;
        } else {
            throw new KodoException('源文件名称不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $destBucketName
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setDestBucketName(string $destBucketName)
    {
        if (ctype_alnum($destBucketName)) {
            $this->destBucketName = $destBucketName;
        } else {
            throw new KodoException('目标空间名称不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $destFileName
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setDestFileName(string $destFileName)
    {
        if (strlen($destFileName) > 0) {
            $this->destFileName = $destFileName;
        } else {
            throw new KodoException('目标文件名称不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param bool $force
     */
    public function setForce(bool $force)
    {
        $this->force = $force;
    }

    public function getDetail() : array
    {
        if (strlen($this->srcBucketName) == 0) {
            throw new KodoException('源空间名称不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
        if (strlen($this->srcFileName) == 0) {
            throw new KodoException('源文件名称不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
        if (strlen($this->destBucketName) == 0) {
            throw new KodoException('目标空间名称不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
        if (strlen($this->destFileName) == 0) {
            throw new KodoException('目标文件名称不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }

        $encodeSrcUri = Util::encodeUri($this->srcBucketName, $this->srcFileName);
        $encodeDestUri = Util::encodeUri($this->destBucketName, $this->destFileName);
        $this->serviceUri = '/copy/' . $encodeSrcUri . '/' . $encodeDestUri . '/force/';
        if ($this->force) {
            $this->serviceUri .= 'true';
        } else {
            $this->serviceUri .= 'false';
        }
        $this->reqHeader['Authorization'] = 'QBox ' . Util::createAccessToken($this->accessKey, $this->serviceUri);
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = '';

        return $this->getContent();
    }
}
