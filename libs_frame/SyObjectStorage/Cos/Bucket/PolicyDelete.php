<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace SyObjectStorage\Cos\Bucket;

use SyObjectStorage\BaseCos;

/**
 * 删除存储桶的权限策略
 *
 * @package SyObjectStorage\Cos\Bucket
 */
class PolicyDelete extends BaseCos
{
    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_DELETE);
        $this->reqUri = '/?policy';
        $this->signParams['policy'] = '';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
