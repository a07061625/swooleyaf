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
 * 上传本地对象至指定存储桶
 * @package QCloud\Cos
 */
class ObjectPut extends CloudBaseCos
{
    /**
     * 对象名称
     * @var string
     */
    private $objectKey = '';

    public function __construct()
    {
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_PUT);
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
     * @param string $filePath
     * @throws \SyException\QCloud\CosException
     */
    public function setFilePath(string $filePath)
    {
        if (file_exists($filePath) && is_readable($filePath)) {
            $this->reqData['media'] = new \CURLFile($filePath);
        } else {
            throw new CosException('文件不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->objectKey) == 0) {
            throw new CosException('对象名称不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        if (!isset($this->reqData['media'])) {
            throw new CosException('文件不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $this->reqData;

        return $this->getContent();
    }
}
