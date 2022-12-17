<?php

namespace SyDingTalk\Oapi\OpenEncrypt;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.openencrypt.updateconfig request
 *
 * @author auto create
 *
 * @since 1.0, 2019.10.09
 */
class UpdateConfigRequest extends BaseRequest
{
    /**
     * 请求参数
     */
    private $topResourceKmsConfig;

    public function setTopResourceKmsConfig($topResourceKmsConfig)
    {
        $this->topResourceKmsConfig = $topResourceKmsConfig;
        $this->apiParas['top_resource_kms_config'] = $topResourceKmsConfig;
    }

    public function getTopResourceKmsConfig()
    {
        return $this->topResourceKmsConfig;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.openencrypt.updateconfig';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
