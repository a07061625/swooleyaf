<?php

namespace SyDingTalk\Oapi\Workspace;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.workspace.task.getbysourceid request
 *
 * @author auto create
 *
 * @since 1.0, 2020.12.23
 */
class TaskGetBySourceIdRequest extends BaseRequest
{
    /**
     * 微应用agentId
     */
    private $agentId;
    /**
     * 任务来源source
     */
    private $source;
    /**
     * 任务来源sourceId
     */
    private $sourceId;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agent_id'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setSource($source)
    {
        $this->source = $source;
        $this->apiParas['source'] = $source;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function setSourceId($sourceId)
    {
        $this->sourceId = $sourceId;
        $this->apiParas['source_id'] = $sourceId;
    }

    public function getSourceId()
    {
        return $this->sourceId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.workspace.task.getbysourceid';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->sourceId, 'sourceId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
