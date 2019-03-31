<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace QCloud\Cos;

use QCloud\CloudBaseCos;

/**
 * 删除存储桶的跨域访问配置信息
 * @package QCloud\Cos
 */
class BucketCorsDelete extends CloudBaseCos {
    public function __construct(){
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_DELETE);
        $this->reqUri = '/?cors';
        $this->signParams['cors'] = '';
    }

    private function __clone(){
    }

    public function getDetail() : array {
        return $this->getContent();
    }
}