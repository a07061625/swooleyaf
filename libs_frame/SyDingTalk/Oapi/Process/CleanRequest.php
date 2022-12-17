<?php

namespace SyDingTalk\Oapi\Process;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.process.clean request
 *
 * @author auto create
 *
 * @since 1.0, 2019.12.26
 */
class CleanRequest extends BaseRequest
{
    /**
     * 企业id
     */
    private $corpid;
    /**
     * 模板唯一码
     */
    private $processCode;

    public function setCorpid($corpid)
    {
        $this->corpid = $corpid;
        $this->apiParas['corpid'] = $corpid;
    }

    public function getCorpid()
    {
        return $this->corpid;
    }

    public function setProcessCode($processCode)
    {
        $this->processCode = $processCode;
        $this->apiParas['process_code'] = $processCode;
    }

    public function getProcessCode()
    {
        return $this->processCode;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.process.clean';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->processCode, 'processCode');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
