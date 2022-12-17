<?php

namespace SyDingTalk\Oapi\Workspace;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.workspace.update request
 *
 * @author auto create
 *
 * @since 1.0, 2020.01.17
 */
class UpdateRequest extends BaseRequest
{
    /**
     * 修改项目/圈子信息
     */
    private $updateInfo;

    public function setUpdateInfo($updateInfo)
    {
        $this->updateInfo = $updateInfo;
        $this->apiParas['update_info'] = $updateInfo;
    }

    public function getUpdateInfo()
    {
        return $this->updateInfo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.workspace.update';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
