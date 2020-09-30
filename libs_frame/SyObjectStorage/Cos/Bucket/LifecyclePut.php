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
 * 设置存储桶的生命周期配置
 *
 * @package SyObjectStorage\Cos\Bucket
 */
class LifecyclePut extends BaseCos
{
    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_PUT);
        $this->reqUri = '/?lifecycle';
        $this->signParams['lifecycle'] = '';
    }

    private function __clone()
    {
    }

    /**
     * @param array $data
     *
     * @throws \SyException\ObjectStorage\CosException
     */
    public function setLifecycleConfig(array $data)
    {
        if (empty($data)) {
            throw new CosException('生命周期配置不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }

        $this->reqData = $data;
    }

    public function getDetail() : array
    {
        if (empty($this->reqData)) {
            throw new CosException('生命周期配置不能为空', ErrorCode::OBJECT_STORAGE_COS_PARAM_ERROR);
        }
        $content = Tool::arrayToXml($this->reqData, 2);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $content;
        $this->reqHeader['Content-Length'] = strlen($content);
        $this->reqHeader['Content-MD5'] = md5(base64_encode($content));

        return $this->getContent();
    }
}
