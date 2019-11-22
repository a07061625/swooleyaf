<?php
/**
 * 资源元信息查询
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 12:37
 */
namespace QiNiu\Kodo\Object;

use QiNiu\QiNiuBaseKodo;
use QiNiu\QiNiuUtilBase;
use SyConstant\ErrorCode;
use SyException\QiNiu\KodoException;

class FileMetadataGet extends QiNiuBaseKodo
{
    /**
     * 空间名称
     * @var string
     */
    private $bucketName = '';
    /**
     * 文件名称
     * @var string
     */
    private $fileName = '';

    public function __construct()
    {
        parent::__construct();
        $this->setServiceHost('rs.qiniu.com');
    }

    private function __clone()
    {
    }

    /**
     * @param string $bucketName
     * @throws \SyException\QiNiu\KodoException
     */
    public function setBucketName(string $bucketName)
    {
        if (ctype_alnum($bucketName)) {
            $this->bucketName = $bucketName;
        } else {
            throw new KodoException('空间名称不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $fileName
     * @throws \SyException\QiNiu\KodoException
     */
    public function setFileName(string $fileName)
    {
        if (strlen($fileName) > 0) {
            $this->fileName = $fileName;
        } else {
            throw new KodoException('文件名称不合法', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->bucketName) == 0) {
            throw new KodoException('空间名称不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }
        if (strlen($this->fileName) == 0) {
            throw new KodoException('文件名称不能为空', ErrorCode::QINIU_KODO_PARAM_ERROR);
        }

        $this->serviceUri = '/stat/' . QiNiuUtilBase::encodeUri($this->bucketName, $this->fileName);
        $this->reqHeader['Authorization'] = 'QBox ' . QiNiuUtilBase::createAccessToken($this->serviceUri);
        return $this->getContent();
    }
}
