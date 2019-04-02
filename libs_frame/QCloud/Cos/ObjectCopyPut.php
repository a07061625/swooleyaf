<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace QCloud\Cos;

use Constant\ErrorCode;
use Exception\QCloud\CosException;
use QCloud\CloudBaseCos;

/**
 * 复制文件
 * @package QCloud\Cos
 */
class ObjectCopyPut extends CloudBaseCos {
    /**
     * 对象名称
     * @var string
     */
    private $objectKey = '';

    public function __construct(){
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_PUT);
    }

    private function __clone(){
    }

    /**
     * @param string $objectKey
     * @throws \Exception\QCloud\CosException
     */
    public function setObjectKey(string $objectKey){
        if(strlen($objectKey) > 0){
            $this->reqUri = '/' . $objectKey;
            $this->objectKey = $objectKey;
        } else {
            throw new CosException('对象名称不合法', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(strlen($this->objectKey) == 0){
            throw new CosException('对象名称不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        if(!isset($this->reqHeader['x-cos-copy-source'])){
            throw new CosException('源文件URL路径不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }

        return $this->getContent();
    }
}