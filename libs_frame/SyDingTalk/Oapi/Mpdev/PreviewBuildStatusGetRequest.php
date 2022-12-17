<?php

namespace SyDingTalk\Oapi\Mpdev;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.mpdev.previewbuild.status.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.15
 */
class PreviewBuildStatusGetRequest extends BaseRequest
{
    /**
     * 小程序ID
     */
    private $miniappId;
    /**
     * 任务ID
     */
    private $taskId;

    public function setMiniappId($miniappId)
    {
        $this->miniappId = $miniappId;
        $this->apiParas['miniapp_id'] = $miniappId;
    }

    public function getMiniappId()
    {
        return $this->miniappId;
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
        return 'dingtalk.oapi.mpdev.previewbuild.status.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->miniappId, 'miniappId');
        RequestCheckUtil::checkNotNull($this->taskId, 'taskId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
