<?php
/**
 * 获取Bucket空间域名
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 11:30
 */
namespace SyObjectStorage\Kodo\Bucket;

use SyObjectStorage\BaseKodo;
use SyCloud\QiNiu\Util;
use SyConstant\ErrorCode;
use SyException\ObjectStorage\KodoException;

class DomainListGet extends BaseKodo
{
    /**
     * 空间名称
     * @var string
     */
    private $bucketName = '';
    
    public function __construct()
    {
        parent::__construct();
        $this->setServiceHost('api.qiniu.com');
    }

    private function __clone()
    {
    }

    /**
     * @param string $bucketName
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setBucketName(string $bucketName)
    {
        if (ctype_alnum($bucketName)) {
            $this->reqData['tbl'] = $bucketName;
        } else {
            throw new KodoException('空间名称不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['tbl'])) {
            throw new KodoException('空间名称不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }

        $this->serviceUri = '/v6/domain/list?' . http_build_query($this->reqData);
        $this->reqHeader['Authorization'] = 'QBox ' . Util::createAccessToken($this->serviceUri);
        return $this->getContent();
    }
}
