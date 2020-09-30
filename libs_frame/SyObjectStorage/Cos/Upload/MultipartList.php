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
 * 获取进行中的分块上传列表
 *
 * @package SyObjectStorage\Cos\Upload
 */
class MultipartList extends BaseCos
{
    /**
     * 前缀
     *
     * @var string
     */
    private $prefix = '';
    /**
     * 定界符
     *
     * @var string
     */
    private $delimiter = '';
    /**
     * 编码方式
     *
     * @var string
     */
    private $encoding_type = '';
    /**
     * 起始索引
     *
     * @var string
     */
    private $marker_key = '';
    /**
     * 起始ID
     *
     * @var string
     */
    private $marker_upload_id = '';
    /**
     * 条目数
     *
     * @var int
     */
    private $limit = 0;

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_GET);
        $this->reqUri = '/?uploads';
        $this->signParams['uploads'] = '';
        $this->reqData['encoding-type'] = 'url';
        $this->reqData['max-uploads'] = 20;
    }

    private function __clone()
    {
    }

    /**
     * @param string $prefix
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setPrefix(string $prefix)
    {
        if (strlen($prefix) > 0) {
            $this->reqData['prefix'] = $prefix;
        } else {
            throw new CosException('前缀不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    /**
     * @param string $delimiter
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setDelimiter(string $delimiter)
    {
        if (strlen($delimiter) > 0) {
            $this->reqData['delimiter'] = $delimiter;
        } else {
            throw new CosException('定界符不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    /**
     * @param string $markerKey
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setMarkerKey(string $markerKey)
    {
        if (strlen($markerKey) > 0) {
            $this->reqData['key-marker'] = $markerKey;
        } else {
            throw new CosException('起始索引不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    /**
     * @param string $markerUploadId
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setMarkerUploadId(string $markerUploadId)
    {
        if (strlen($markerUploadId) > 0) {
            $this->reqData['upload-id-marker'] = $markerUploadId;
        } else {
            throw new CosException('起始ID不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    /**
     * @param int $limit
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setLimit(int $limit)
    {
        if (($limit > 0) && ($limit <= 1000)) {
            $this->reqData['max-uploads'] = $limit;
        } else {
            throw new CosException('条目数不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        $this->setReqQuery($this->reqData);

        return $this->getContent();
    }
}
