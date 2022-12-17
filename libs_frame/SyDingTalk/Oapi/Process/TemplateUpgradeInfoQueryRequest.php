<?php

namespace SyDingTalk\Oapi\Process;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.process.template.upgradeinfo.query request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class TemplateUpgradeInfoQueryRequest extends BaseRequest
{
    /**
     * 流程编码List<String>类型
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
        return 'dingtalk.oapi.process.template.upgradeinfo.query';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->processCodes, 'processCodes');
        RequestCheckUtil::checkMaxListSize($this->processCodes, 20, 'processCodes');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
