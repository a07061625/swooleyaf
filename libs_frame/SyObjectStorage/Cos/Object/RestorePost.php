<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace SyObjectStorage\Cos\Object;

use SyConstant\ErrorCode;
use SyException\ObjectStorage\CosException;
use SyObjectStorage\BaseCos;
use SyTool\Tool;

/**
 * 恢复archive类型的对象
 *
 * @package SyObjectStorage\Cos\Object
 */
class RestorePost extends BaseCos
{
    /**
     * 对象名称
     *
     * @var string
     */
    private $objectKey = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_POST);
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
            $this->reqUri = '/' . $objectKey . '?restore';
            $this->objectKey = $objectKey;
            $this->signParams['restore'] = '';
        } else {
            throw new CosException('对象名称不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    /**
     * @param array $restoreConfig
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setRestoreConfig(array $restoreConfig)
    {
        if (empty($restoreConfig)) {
            throw new CosException('恢复配置不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }

        $this->reqData = $restoreConfig;
    }

    public function getDetail() : array
    {
        if (strlen($this->objectKey) == 0) {
            throw new CosException('对象名称不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        if (empty($this->reqData)) {
            throw new CosException('恢复配置不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::arrayToXml($this->reqData, 2);

        return $this->getContent();
    }
}
