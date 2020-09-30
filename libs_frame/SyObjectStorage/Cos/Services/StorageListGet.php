<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace SyObjectStorage\Cos\Services;

use SyObjectStorage\BaseCos;

/**
 * 获取所有存储空间列表
 *
 * @package SyObjectStorage\Cos\Services
 */
class StorageListGet extends BaseCos
{
    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setReqHost('service.cos.myqcloud.com');
        $this->setReqMethod(self::REQ_METHOD_GET);
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
