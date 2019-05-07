<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace QCloud\Cos;

use QCloud\CloudBaseCos;

/**
 * 获取所有存储空间列表
 * @package QCloud\Cos
 */
class ServiceGet extends CloudBaseCos
{
    public function __construct()
    {
        parent::__construct();
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
