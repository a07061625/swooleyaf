<?php

namespace SyDingTalk\Oapi\Message;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.message.mass.recall request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.19
 */
class MassRecallRequest extends BaseRequest
{
    /**
     * 消息发送任务id
     */
    private $taskId;
    /**
     * 服务号的unionid
     */
    private $unionid;

    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;
        $this->apiParas['task_id'] = $taskId;
    }

    public function getTaskId()
    {
        return $this->taskId;
    }

    public function setUnionid($unionid)
    {
        $this->unionid = $unionid;
        $this->apiParas['unionid'] = $unionid;
    }

    public function getUnionid()
    {
        return $this->unionid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.message.mass.recall';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->taskId, 'taskId');
        RequestCheckUtil::checkMaxLength($this->taskId, 128, 'taskId');
        RequestCheckUtil::checkNotNull($this->unionid, 'unionid');
        RequestCheckUtil::checkMaxLength($this->unionid, 128, 'unionid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
