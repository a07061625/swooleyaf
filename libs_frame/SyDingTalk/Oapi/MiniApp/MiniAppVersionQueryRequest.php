<?php

namespace SyDingTalk\Oapi\MiniApp;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.miniapp.miniappversion.query request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.28
 */
class MiniAppVersionQueryRequest extends BaseRequest
{
    /**
     * 查询参数
     */
    private $modelKey;

    public function setModelKey($modelKey)
    {
        $this->modelKey = $modelKey;
        $this->apiParas['model_key'] = $modelKey;
    }

    public function getModelKey()
    {
        return $this->modelKey;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.miniapp.miniappversion.query';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->modelKey, 'modelKey');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
