<?php
/**
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 18:24
 */
namespace QCloud\Cos;

use Constant\ErrorCode;
use SyException\QCloud\CosException;
use QCloud\CloudBaseCos;
use Tool\Tool;

/**
 * 设置存储桶的权限策略
 * @package QCloud\Cos
 */
class BucketPolicyPut extends CloudBaseCos
{
    public function __construct()
    {
        parent::__construct();
        $this->setReqHost();
        $this->setReqMethod(self::REQ_METHOD_PUT);
        $this->reqUri = '/?policy';
        $this->signParams['policy'] = '';
        $this->reqHeader['Content-Type'] = 'application/json';
    }

    private function __clone()
    {
    }

    /**
     * @param array $data
     * @throws \SyException\QCloud\CosException
     */
    public function setPolicyConfig(array $data)
    {
        if (empty($data)) {
            throw new CosException('权限策略不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }

        $this->reqData = $data;
    }

    public function getDetail() : array
    {
        if (empty($this->reqData)) {
            throw new CosException('权限策略不能为空', ErrorCode::QCLOUD_COS_PARAM_ERROR);
        }
        $content = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $content;
        $this->reqHeader['Content-MD5'] = md5(base64_encode($content));

        return $this->getContent();
    }
}
