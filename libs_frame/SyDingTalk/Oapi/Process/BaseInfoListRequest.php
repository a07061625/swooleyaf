<?php

namespace SyDingTalk\Oapi\Process;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.process.baseinfo.list request
 *
 * @author auto create
 *
 * @since 1.0, 2021.12.14
 */
class BaseInfoListRequest extends BaseRequest
{
    /**
     * 模板code列表
     */
    private $processCodes;

    public function setProcessCodes($processCodes)
    {
        $this->processCodes = $processCodes;
        $this->apiParas['process_codes'] = $processCodes;
    }

    public function getProcessCodes()
    {
        return $this->processCodes;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.process.baseinfo.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->processCodes, 20, 'processCodes');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
