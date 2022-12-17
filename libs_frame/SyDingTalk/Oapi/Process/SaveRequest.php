<?php

namespace SyDingTalk\Oapi\Process;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.process.save request
 *
 * @author auto create
 *
 * @since 1.0, 2021.10.29
 */
class SaveRequest extends BaseRequest
{
    /**
     * 入参
     */
    private $saveProcessRequest;

    public function setSaveProcessRequest($saveProcessRequest)
    {
        $this->saveProcessRequest = $saveProcessRequest;
        $this->apiParas['saveProcessRequest'] = $saveProcessRequest;
    }

    public function getSaveProcessRequest()
    {
        return $this->saveProcessRequest;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.process.save';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
