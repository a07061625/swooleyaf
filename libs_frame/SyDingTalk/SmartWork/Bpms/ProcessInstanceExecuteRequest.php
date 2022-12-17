<?php

namespace SyDingTalk\SmartWork\Bpms;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.smartwork.bpms.processinstance.execute request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class ProcessInstanceExecuteRequest extends BaseRequest
{
    /**
     * 操作人id，通过dingtalk.smartwork.bpms.processinstance.get这个接口可以获取
     */
    private $actionerUserid;
    /**
     * 审批实例id
     */
    private $processInstanceId;
    /**
     * 操作评论，可为空
     */
    private $remark;
    /**
     * 审批操作，同意-agree，拒绝-refuse
     */
    private $result;
    /**
     * 任务节点id，dingtalk.smartwork.bpms.processinstance.get接口可获取
     */
    private $taskId;

    public function setActionerUserid($actionerUserid)
    {
        $this->actionerUserid = $actionerUserid;
        $this->apiParas['actioner_userid'] = $actionerUserid;
    }

    public function getActionerUserid()
    {
        return $this->actionerUserid;
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

    public function setRemark($remark)
    {
        $this->remark = $remark;
        $this->apiParas['remark'] = $remark;
    }

    public function getRemark()
    {
        return $this->remark;
    }

    public function setResult($result)
    {
        $this->result = $result;
        $this->apiParas['result'] = $result;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;
        $this->apiParas['task_id'] = $taskId;
    }

    public function getTaskId()
    {
        return $this->taskId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.smartwork.bpms.processinstance.execute';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->actionerUserid, 'actionerUserid');
        RequestCheckUtil::checkNotNull($this->processInstanceId, 'processInstanceId');
        RequestCheckUtil::checkMaxLength($this->remark, 2000, 'remark');
        RequestCheckUtil::checkNotNull($this->result, 'result');
        RequestCheckUtil::checkNotNull($this->taskId, 'taskId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
