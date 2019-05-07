<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace QCloud\Cos;

use QCloud\CloudBaseCos;

/**
 * 获取存储桶的地域信息
 * @package QCloud\Cos
 */
class BucketLocationGet extends CloudBaseCos
{
    public function __construct()
    {
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_GET);
        $this->reqUri = '/?location';
        $this->signParams['location'] = '';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
