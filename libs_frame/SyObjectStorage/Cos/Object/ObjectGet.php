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
 * 下载单个对象
 *
 * @package SyObjectStorage\Cos\Object
 */
class ObjectGet extends BaseCos
{
    /**
     * 对象名称
     *
     * @var string
     */
    private $objectKey = '';
    /**
     * 响应头content-type
     *
     * @var string
     */
    private $response_content_type = '';
    /**
     * 响应头content-language
     *
     * @var string
     */
    private $response_content_language = '';
    /**
     * 响应头expires
     *
     * @var string
     */
    private $response_expires = '';
    /**
     * 响应头cache-control
     *
     * @var string
     */
    private $response_cache_control = '';
    /**
     * 响应头content-disposition
     *
     * @var string
     */
    private $response_content_disposition = '';
    /**
     * 响应头content-encoding
     *
     * @var string
     */
    private $response_content_encoding = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_GET);
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
     * @param string $contentType
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setResponseContentType(string $contentType)
    {
        if (strlen($contentType) > 0) {
            $this->reqData['response-content-type'] = $contentType;
            $this->signParams['response-content-type'] = $contentType;
        } else {
            throw new CosException('响应头content-type不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    /**
     * @param string $contentLanguage
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setResponseContentLanguage(string $contentLanguage)
    {
        if (strlen($contentLanguage) > 0) {
            $this->reqData['response-content-language'] = $contentLanguage;
            $this->signParams['response-content-language'] = $contentLanguage;
        } else {
            throw new CosException('响应头content-language不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    /**
     * @param string $expires
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setResponseExpires(string $expires)
    {
        if (strlen($expires) > 0) {
            $this->reqData['response-expires'] = $expires;
            $this->signParams['response-expires'] = $expires;
        } else {
            throw new CosException('响应头expires不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    /**
     * @param string $cacheControl
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setResponseCacheControl(string $cacheControl)
    {
        if (strlen($cacheControl) > 0) {
            $this->reqData['response-cache-control'] = $cacheControl;
            $this->signParams['response-cache-control'] = $cacheControl;
        } else {
            throw new CosException('响应头cache-control不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    /**
     * @param string $contentDisposition
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setResponseContentDisposition(string $contentDisposition)
    {
        if (strlen($contentDisposition) > 0) {
            $this->reqData['response-content-disposition'] = $contentDisposition;
            $this->signParams['response-content-disposition'] = $contentDisposition;
        } else {
            throw new CosException('响应头content-disposition不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    /**
     * @param string $contentEncoding
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setResponseContentEncoding(string $contentEncoding)
    {
        if (strlen($contentEncoding) > 0) {
            $this->reqData['response-content-encoding'] = $contentEncoding;
            $this->signParams['response-content-encoding'] = $contentEncoding;
        } else {
            throw new CosException('响应头content-encoding不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->objectKey) == 0) {
            throw new CosException('对象名称不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        $this->setReqQuery($this->reqData);

        return $this->getContent();
    }
}
