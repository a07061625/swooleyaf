<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace QCloud\Cos;

use SyConstant\ErrorCode;
use SyException\QCloud\CosException;
use QCloud\CloudBaseCos;

/**
 * 舍弃并删除一个上传分块
 * @package QCloud\Cos
 */
class MultipartUploadAbort extends CloudBaseCos
{
    /**
     * 对象名称
     * @var string
     */
    private $objectKey = '';
    /**
     * 上传ID
     * @var string
     */
    private $uploadId = '';

    public function __construct()
    {
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_DELETE);
    }

    private function __clone()
    {
    }

    /**
     * @param string $objectKey
     * @throws \SyException\QCloud\CosException
     */
    public function setObjectKey(string $objectKey)
    {
        if (strlen($objectKey) > 0) {
            $this->reqUri = '/' . $objectKey;
            $this->objectKey = $objectKey;
        } else {
            throw new CosException('对象名称不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    /**
     * @param string $uploadId
     * @throws \SyException\QCloud\CosException
     */
    public function setUploadId(string $uploadId)
    {
        if (strlen($uploadId) > 0) {
            $this->signParams['uploadid'] = $uploadId;
            $this->reqData['uploadId'] = $uploadId;
        } else {
            throw new CosException('上传ID不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->objectKey) == 0) {
            throw new CosException('对象名称不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        if (!isset($this->reqData['uploadId'])) {
            throw new CosException('上传ID不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        $this->setReqQuery($this->reqData);
        return $this->getContent();
    }
}
