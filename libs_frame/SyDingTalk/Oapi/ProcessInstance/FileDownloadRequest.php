<?php

namespace SyDingTalk\Oapi\ProcessInstance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.processinstance.file.download request
 *
 * @author auto create
 *
 * @since 1.0, 2020.01.03
 */
class FileDownloadRequest extends BaseRequest
{
    /**
     * 企业应用标识
     */
    private $agentId;
    /**
     * 文件id
     */
    private $fileId;
    /**
     * 流程实例id
     */
    private $processInstanceId;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agent_id'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setFileId($fileId)
    {
        $this->fileId = $fileId;
        $this->apiParas['file_id'] = $fileId;
    }

    public function getFileId()
    {
        return $this->fileId;
    }

    public function setProcessInstanceId($processInstanceId)
    {
        $this->processInstanceId = $processInstanceId;
        $this->apiParas['process_instance_id'] = $processInstanceId;
    }

    public function getProcessInstanceId()
    {
        return $this->processInstanceId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.processinstance.file.download';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->agentId, 'agentId');
        RequestCheckUtil::checkNotNull($this->fileId, 'fileId');
        RequestCheckUtil::checkNotNull($this->processInstanceId, 'processInstanceId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
