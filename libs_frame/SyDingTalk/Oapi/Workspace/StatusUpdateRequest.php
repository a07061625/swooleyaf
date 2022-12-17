<?php

namespace SyDingTalk\Oapi\Workspace;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.workspace.status.update request
 *
 * @author auto create
 *
 * @since 1.0, 2020.02.17
 */
class StatusUpdateRequest extends BaseRequest
{
    /**
     * 更新状态
     */
    private $updateStatus;

    public function setUpdateStatus($updateStatus)
    {
        $this->updateStatus = $updateStatus;
        $this->apiParas['update_status'] = $updateStatus;
    }

    public function getUpdateStatus()
    {
        return $this->updateStatus;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.workspace.status.update';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
