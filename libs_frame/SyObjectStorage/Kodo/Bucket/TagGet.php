<?php
/**
 * 查询空间标签
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 11:30
 */
namespace SyObjectStorage\Kodo\Bucket;

use SyCloud\QiNiu\Util;
use SyConstant\ErrorCode;
use SyException\ObjectStorage\KodoException;
use SyObjectStorage\BaseKodo;

class TagGet extends BaseKodo
{
    /**
     * 空间名称
     *
     * @var string
     */
    private $bucketName = '';
    
    public function __construct(string $accessKey)
    {
        parent::__construct($accessKey);
        $this->setServiceHost('uc.qbox.me');
        $this->reqHeader['Content-Type'] = 'application/json';
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
            $this->reqData['bucket'] = $bucketName;
        } else {
            throw new KodoException('空间名称不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['bucket'])) {
            throw new KodoException('空间名称不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }

        $this->serviceUri = '/bucketTagging?' . http_build_query($this->reqData);
        $this->reqHeader['Authorization'] = 'Qiniu ' . Util::createAccessToken($this->accessKey, $this->serviceUri);

        return $this->getContent();
    }
}
