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
 * 设置存储桶Referer的白名单或者黑名单
 * @package QCloud\Cos
 */
class BucketRefererPut extends CloudBaseCos
{
    public function __construct()
    {
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_PUT);
        $this->reqUri = '/?referer';
        $this->signParams['referer'] = '';
    }

    private function __clone()
    {
    }

    /**
     * @param array $data
     * @throws \Exception\QCloud\CosException
     */
    public function setRefererConfig(array $data)
    {
        if (empty($data)) {
            throw new CosException('Referer配置不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }

        $this->reqData = $data;
    }

    public function getDetail() : array
    {
        if (empty($this->reqData)) {
            throw new CosException('Referer配置不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        $content = Tool::arrayToXml($this->reqData, 2);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $content;
        $this->reqHeader['Content-Length'] = strlen($content);
        $this->reqHeader['Content-MD5'] = md5(base64_encode($content));

        return $this->getContent();
    }
}
