<?php

namespace SyDingTalk\Oapi\Org;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.org.openencrypt.registekms request
 *
 * @author auto create
 *
 * @since 1.0, 2019.10.09
 */
class OpenEncryptRegistekmsRequest extends BaseRequest
{
    /**
     * 请求参数
     */
    private $topKmsMeta;

    public function setTopKmsMeta($topKmsMeta)
    {
        $this->topKmsMeta = $topKmsMeta;
        $this->apiParas['top_kms_meta'] = $topKmsMeta;
    }

    public function getTopKmsMeta()
    {
        return $this->topKmsMeta;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.org.openencrypt.registekms';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
