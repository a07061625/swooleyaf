<?php

namespace SyDingTalk\Oapi\Inspect;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.inspect.feedback.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.01.14
 */
class FeedbackGetRequest extends BaseRequest
{
    /**
     * 表单标识（传空值，暂时保留）
     */
    private $formId;
    /**
     * 巡店任务唯一标识
     */
    private $taskId;

    public function setFormId($formId)
    {
        $this->formId = $formId;
        $this->apiParas['form_id'] = $formId;
    }

    public function getFormId()
    {
        return $this->formId;
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
        return 'dingtalk.oapi.inspect.feedback.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->taskId, 'taskId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
