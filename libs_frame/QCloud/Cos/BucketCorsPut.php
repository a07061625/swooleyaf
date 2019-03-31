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
use Tool\Tool;

/**
 * 设置存储桶的跨域访问配置信息
 * @package QCloud\Cos
 */
class BucketCorsPut extends CloudBaseCos {
    public function __construct(){
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_PUT);
        $this->reqUri = '/?cors';
        $this->signParams['cors'] = '';
        $this->reqHeader['Content-Type'] = 'application/xml';
    }

    private function __clone(){
    }

    /**
     * @param array $data
     * @throws \Exception\QCloud\CosException
     */
    public function setCorConfig(array $data){
        if(empty($data)){
            throw new CosException('跨域访问配置不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }

        $this->reqData = $data;
    }

    public function getDetail() : array {
        if(empty($this->reqData)){
            throw new CosException('跨域访问配置不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        $content = '<?xml version="1.0" encoding="UTF-8" ?>' . Tool::arrayToXml($this->reqData);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $content;
        $this->reqHeader['Content-Length'] = strlen($content);
        $this->reqHeader['Content-MD5'] = md5(base64_encode($content));

        return $this->getContent();
    }
}