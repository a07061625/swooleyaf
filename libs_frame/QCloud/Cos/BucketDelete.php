<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace QCloud\Cos;

use QCloud\CloudBaseCos;

/**
 * 删除存储桶
 * @package QCloud\Cos
 */
class BucketDelete extends CloudBaseCos {
    public function __construct(){
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_DELETE);
    }

    private function __clone(){
    }

    public function getDetail() : array {
        return $this->getContent();
    }
}