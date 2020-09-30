<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace SyObjectStorage\Cos\Bucket;

use SyConstant\ErrorCode;
use SyException\ObjectStorage\CosException;
use SyObjectStorage\BaseCos;
use SyTool\Tool;

/**
 * 设置存储桶Referer的白名单或者黑名单
 *
 * @package SyObjectStorage\Cos\Bucket
 */
class RefererPut extends BaseCos
{
    public function __construct(string $appId)
    {
        parent::__construct($appId);
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
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setRefererConfig(array $data)
    {
        if (empty($data)) {
            throw new CosException('Referer配置不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }

        $this->reqData = $data;
    }

    public function getDetail() : array
    {
        if (empty($this->reqData)) {
            throw new CosException('Referer配置不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        $content = Tool::arrayToXml($this->reqData, 2);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $content;
        $this->reqHeader['Content-Length'] = strlen($content);
        $this->reqHeader['Content-MD5'] = md5(base64_encode($content));

        return $this->getContent();
    }
}
