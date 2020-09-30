<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace SyObjectStorage\Cos\Bucket;

use SyObjectStorage\BaseCos;

/**
 * 删除存储桶的跨域访问配置信息
 *
 * @package SyObjectStorage\Cos\Bucket
 */
class CorsDelete extends BaseCos
{
    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_DELETE);
        $this->reqUri = '/?cors';
        $this->signParams['cors'] = '';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
