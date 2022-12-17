<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.edu.card.user.task.submit request
 *
 * @author auto create
 *
 * @since 1.0, 2020.12.29
 */
class CardUserTaskSubmitRequest extends BaseRequest
{
    /**
     * 参数
     */
    private $taskparam;

    public function setTaskparam($taskparam)
    {
        $this->taskparam = $taskparam;
        $this->apiParas['taskparam'] = $taskparam;
    }

    public function getTaskparam()
    {
        return $this->taskparam;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.card.user.task.submit';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
