<?php

namespace SyDingTalk\Oapi\Workspace;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.workspace.task.deletebyproject request
 *
 * @author auto create
 *
 * @since 1.0, 2020.08.28
 */
class TaskDeleteByProjectRequest extends BaseRequest
{
    /**
     * 微应用agentId
     */
    private $microappAgentId;
    /**
     * 操作者id
     */
    private $operatorUserid;
    /**
     * 任务所属项目(虚拟企业），基于项目空间的项目
     */
    private $projectId;

    public function setMicroappAgentId($microappAgentId)
    {
        $this->microappAgentId = $microappAgentId;
        $this->apiParas['microapp_agent_id'] = $microappAgentId;
    }

    public function getMicroappAgentId()
    {
        return $this->microappAgentId;
    }

    public function setOperatorUserid($operatorUserid)
    {
        $this->operatorUserid = $operatorUserid;
        $this->apiParas['operator_userid'] = $operatorUserid;
    }

    public function getOperatorUserid()
    {
        return $this->operatorUserid;
    }

    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
        $this->apiParas['project_id'] = $projectId;
    }

    public function getProjectId()
    {
        return $this->projectId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.workspace.task.deletebyproject';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->operatorUserid, 'operatorUserid');
        RequestCheckUtil::checkNotNull($this->projectId, 'projectId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
