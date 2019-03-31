<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace QCloud\Cos;

use QCloud\CloudBaseCos;

/**
 * 获取存储桶的生命周期配置
 * @package QCloud\Cos
 */
class BucketLifecycleGet extends CloudBaseCos {
    public function __construct(){
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_GET);
        $this->reqUri = '/?lifecycle';
        $this->signParams['lifecycle'] = '';
    }

    private function __clone(){
    }

    public function getDetail() : array {
        return $this->getContent();
    }
}