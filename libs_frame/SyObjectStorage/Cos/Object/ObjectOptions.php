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

/**
 * 对象跨域访问预请求
 *
 * @package SyObjectStorage\Cos\Object
 */
class ObjectOptions extends BaseCos
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
        $this->setReqMethod(self::REQ_METHOD_OPTIONS);
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

    public function getDetail() : array
    {
        if (strlen($this->objectKey) == 0) {
            throw new CosException('对象名称不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        if (!isset($this->reqHeader['Origin'])) {
            throw new CosException('请求来源域名不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        if (!isset($this->reqHeader['Access-Control-Request-Method'])) {
            throw new CosException('请求方法不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
