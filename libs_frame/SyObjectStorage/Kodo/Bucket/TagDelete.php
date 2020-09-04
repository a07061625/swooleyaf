<?php
/**
 * 删除空间标签
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 11:30
 */
namespace SyObjectStorage\Kodo\Bucket;

use SyObjectStorage\BaseKodo;
use SyCloud\QiNiu\Util;
use SyConstant\ErrorCode;
use SyException\ObjectStorage\KodoException;

class TagDelete extends BaseKodo
{
    /**
     * 空间名称
     * @var string
     */
    private $bucketName = '';
    
    public function __construct()
    {
        parent::__construct();
        $this->setServiceHost('uc.qbox.me');
        $this->reqHeader['Content-Type'] = 'application/json';
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
        $this->reqHeader['Authorization'] = 'Qiniu ' . Util::createAccessToken($this->serviceUri);
        $this->curlConfigs[CURLOPT_CUSTOMREQUEST] = 'DELETE';
        $this->curlConfigs[CURLOPT_POSTFIELDS] = '';
        return $this->getContent();
    }
}
