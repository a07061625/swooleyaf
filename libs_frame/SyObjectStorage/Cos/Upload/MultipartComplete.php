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
 * 完成分块上传
 *
 * @package SyObjectStorage\Cos\Upload
 */
class MultipartComplete extends BaseCos
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
     * 节点信息列表
     *
     * @var array
     */
    private $nodeList = [];

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
            $this->signParams['uploadid'] = $uploadId;
            $this->uploadId = $uploadId;
        } else {
            throw new CosException('上传ID不合法', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
    }

    /**
     * @param array $nodeList
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setNodeList(array $nodeList)
    {
        if (empty($nodeList)) {
            throw new CosException('节点信息不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }

        $this->nodeList = $nodeList;
    }

    public function getDetail() : array
    {
        if (strlen($this->objectKey) == 0) {
            throw new CosException('对象名称不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        if (strlen($this->uploadId) == 0) {
            throw new CosException('上传ID不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        if (empty($this->nodeList)) {
            throw new CosException('节点信息不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        $this->setReqQuery([
            'uploadId' => $this->uploadId,
        ]);

        $content = '<CompleteMultipartUpload>';
        foreach ($this->nodeList as $eNode) {
            $content .= '<Part><PartNumber>' . $eNode['number'] . '</PartNumber><ETag>"' . $eNode['etag'] . '"</ETag></Part>';
        }
        $content .= '</CompleteMultipartUpload>';
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $content;
        $this->reqHeader['Content-Length'] = strlen($content);

        return $this->getContent();
    }
}
