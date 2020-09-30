<?php
/**
 * 修改文件存储类型
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 12:37
 */
namespace SyObjectStorage\Kodo\Object;

use SyCloud\QiNiu\Util;
use SyConstant\ErrorCode;
use SyException\ObjectStorage\KodoException;
use SyObjectStorage\BaseKodo;

class FileTypeUpdate extends BaseKodo
{
    /**
     * 空间名称
     *
     * @var string
     */
    private $bucketName = '';
    /**
     * 文件名称
     *
     * @var string
     */
    private $fileName = '';
    /**
     * 文件存储类型 0:标准存储 1:低频存储
     *
     * @var int
     */
    private $type = -1;

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
     * @param string $bucketName
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setBucketName(string $bucketName)
    {
        if (ctype_alnum($bucketName)) {
            $this->bucketName = $bucketName;
        } else {
            throw new KodoException('空间名称不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param string $fileName
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setFileName(string $fileName)
    {
        if (strlen($fileName) > 0) {
            $this->fileName = $fileName;
        } else {
            throw new KodoException('文件名称不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param int $type
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setType(int $type)
    {
        if (in_array($type, [0, 1])) {
            $this->type = $type;
        } else {
            throw new KodoException('文件存储类型不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->bucketName) == 0) {
            throw new KodoException('空间名称不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
        if (strlen($this->fileName) == 0) {
            throw new KodoException('文件名称不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
        if ($this->type < 0) {
            throw new KodoException('文件存储类型不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }

        $encodeUri = Util::encodeUri($this->bucketName, $this->fileName);
        $this->serviceUri = '/chtype/' . $encodeUri . '/type/' . $this->type;
        $this->reqHeader['Authorization'] = 'QBox ' . Util::createAccessToken($this->accessKey, $this->serviceUri);
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = '';

        return $this->getContent();
    }
}
