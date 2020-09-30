<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace SyObjectStorage\Cos\Bucket;

use SyObjectStorage\BaseCos;

/**
 * 获取存储桶的访问权限控制列表
 * @package SyObjectStorage\Cos\Bucket
 */
class AclGet extends BaseCos
{
    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_GET);
        $this->reqUri = '/?acl';
        $this->signParams['acl'] = '';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
