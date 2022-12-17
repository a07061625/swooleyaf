<?php

namespace SyDingTalk\Oapi\Process;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.process.sync request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class SyncRequest extends BaseRequest
{
    /**
     * 企业微应用标识
     */
    private $agentId;
    /**
     * 业务分类标识（建议采用JAVA包名的命名方式,如:com.alibaba）
     */
    private $bizCategoryId;
    /**
     * 审批流名称
     */
    private $processName;
    /**
     * 源审批流的唯一码
     */
    private $srcProcessCode;
    /**
     * 目标审批流的唯一码
     */
    private $targetProcessCode;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agent_id'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setBizCategoryId($bizCategoryId)
    {
        $this->bizCategoryId = $bizCategoryId;
        $this->apiParas['biz_category_id'] = $bizCategoryId;
    }

    public function getBizCategoryId()
    {
        return $this->bizCategoryId;
    }

    public function setProcessName($processName)
    {
        $this->processName = $processName;
        $this->apiParas['process_name'] = $processName;
    }

    public function getProcessName()
    {
        return $this->processName;
    }

    public function setSrcProcessCode($srcProcessCode)
    {
        $this->srcProcessCode = $srcProcessCode;
        $this->apiParas['src_process_code'] = $srcProcessCode;
    }

    public function getSrcProcessCode()
    {
        return $this->srcProcessCode;
    }

    public function setTargetProcessCode($targetProcessCode)
    {
        $this->targetProcessCode = $targetProcessCode;
        $this->apiParas['target_process_code'] = $targetProcessCode;
    }

    public function getTargetProcessCode()
    {
        return $this->targetProcessCode;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.process.sync';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->agentId, 'agentId');
        RequestCheckUtil::checkMaxLength($this->bizCategoryId, 64, 'bizCategoryId');
        RequestCheckUtil::checkMaxLength($this->processName, 64, 'processName');
        RequestCheckUtil::checkNotNull($this->srcProcessCode, 'srcProcessCode');
        RequestCheckUtil::checkNotNull($this->targetProcessCode, 'targetProcessCode');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
