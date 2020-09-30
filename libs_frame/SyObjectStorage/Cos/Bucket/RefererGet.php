<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace SyObjectStorage\Cos\Bucket;

use SyObjectStorage\BaseCos;

/**
 * 获取存储桶Referer的白名单或者黑名单
 *
 * @package SyObjectStorage\Cos\Bucket
 */
class RefererGet extends BaseCos
{
    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_GET);
        $this->reqUri = '/?referer';
        $this->signParams['referer'] = '';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
