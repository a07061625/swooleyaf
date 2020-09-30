<?php
/**
 * 设置Bucket访问权限
 * User: 姜伟
 * Date: 2019/11/22 0022
 * Time: 11:30
 */
namespace SyObjectStorage\Kodo\Bucket;

use SyCloud\QiNiu\Util;
use SyConstant\ErrorCode;
use SyException\ObjectStorage\KodoException;
use SyObjectStorage\BaseKodo;

class PermissionSet extends BaseKodo
{
    /**
     * 空间名称
     *
     * @var string
     */
    private $bucket = '';
    /**
     * 权限类型 0:公开 1:私有
     *
     * @var int
     */
    private $private = 0;
    
    public function __construct(string $accessKey)
    {
        parent::__construct($accessKey);
        $this->setServiceHost('uc.qbox.me');
        $this->serviceUri = '/private';
        $this->reqHeader['Content-Type'] = 'application/x-www-form-urlencoded';
    }

    private function __clone()
    {
    }

    /**
     * @param string $bucket
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setBucket(string $bucket)
    {
        if (ctype_alnum($bucket)) {
            $this->reqData['bucket'] = $bucket;
        } else {
            throw new KodoException('空间名称不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    /**
     * @param int $private
     *
     * @throws \SyException\ObjectStorage\KodoException
     */
    public function setPrivate(int $private)
    {
        if (in_array($private, [0, 1])) {
            $this->reqData['private'] = $private;
        } else {
            throw new KodoException('权限类型不合法', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['bucket'])) {
            throw new KodoException('空间名称不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }
        if (!isset($this->reqData['private'])) {
            throw new KodoException('权限类型不能为空', ErrorCode::OBJECT_STORAGE_KODO_PARAM_ERROR);
        }

        $body = http_build_query($this->reqData);
        $this->reqHeader['Authorization'] = 'QBox ' . Util::createAccessToken($this->accessKey, $this->serviceUri, $body);
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $body;

        return $this->getContent();
    }
}
