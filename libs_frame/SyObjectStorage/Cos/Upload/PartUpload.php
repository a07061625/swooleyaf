<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace SyObjectStorage\Cos\Upload;

use SyConstant\ErrorCode;
use SyException\ObjectStorage\CosException;
use SyObjectStorage\BaseCos;

/**
 * 分块上传
 *
 * @package SyObjectStorage\Cos\Upload
 */
class PartUpload extends BaseCos
{
    /**
     * 对象名称
     *
     * @var string
     */
    private $objectKey = '';
    /**
     * 上传ID
     *
     * @var string
     */
    private $uploadId = '';
    /**
     * 上传编号
     *
     * @var int
     */
    private $partNumber = 0;

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_PUT);
    }

    private function __clone()
    {
    }

    /**
     * @param string $objectKey
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setObjectKey(string $objectKey)
    {
        if (strlen($objectKey) > 0) {
            $this->reqUri = '/' . $objectKey;
            $this->objectKey = $objectKey;
        } else {
            throw new CosException('对象名称不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    /**
     * @param string $uploadId
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setUploadId(string $uploadId)
    {
        if (strlen($uploadId) > 0) {
            $this->uploadId = $uploadId;
            $this->signParams['uploadid'] = $uploadId;
        } else {
            throw new CosException('上传ID不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    /**
     * @param int $partNumber
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setPartNumber(int $partNumber)
    {
        if (($partNumber > 0) && ($partNumber <= 10000)) {
            $this->partNumber = $partNumber;
        } else {
            throw new CosException('上传编号不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    /**
     * @param string $content
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setUploadContent(string $content)
    {
        if (strlen($content) > 0) {
            $this->reqData['uploadContent'] = $content;
        } else {
            throw new CosException('上传内容不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->objectKey) == 0) {
            throw new CosException('对象名称不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        if (strlen($this->uploadId) == 0) {
            throw new CosException('上传ID不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        if ($this->partNumber == 0) {
            throw new CosException('上传编号不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        if (!isset($this->reqData['uploadContent'])) {
            throw new CosException('上传内容不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        $this->setReqQuery([
            'uploadId' => $this->uploadId,
            'partNumber' => $this->partNumber,
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $this->reqData['uploadContent'];
        $this->reqHeader['Content-Length'] = strlen($this->reqData['uploadContent']);

        return $this->getContent();
    }
}
