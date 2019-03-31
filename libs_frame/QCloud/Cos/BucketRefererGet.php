<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace QCloud\Cos;

use QCloud\CloudBaseCos;

/**
 * 获取存储桶Referer的白名单或者黑名单
 * @package QCloud\Cos
 */
class BucketRefererGet extends CloudBaseCos {
    public function __construct(){
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_GET);
        $this->reqUri = '/?referer';
        $this->signParams['referer'] = '';
    }

    private function __clone(){
    }

    public function getDetail() : array {
        return $this->getContent();
    }
}