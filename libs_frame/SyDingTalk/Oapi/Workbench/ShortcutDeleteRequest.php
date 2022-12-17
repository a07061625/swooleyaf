<?php

namespace SyDingTalk\Oapi\Workbench;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.workbench.shortcut.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.21
 */
class ShortcutDeleteRequest extends BaseRequest
{
    /**
     * 应用ID
     */
    private $appId;
    /**
     * 系统交互唯一流水号(ISV维度下不可重复)
     */
    private $bizNo;

    public function setAppId($appId)
    {
        $this->appId = $appId;
        $this->apiParas['app_id'] = $appId;
    }

    public function getAppId()
    {
        return $this->appId;
    }

    public function setBizNo($bizNo)
    {
        $this->bizNo = $bizNo;
        $this->apiParas['biz_no'] = $bizNo;
    }

    public function getBizNo()
    {
        return $this->bizNo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.workbench.shortcut.delete';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->appId, 'appId');
        RequestCheckUtil::checkNotNull($this->bizNo, 'bizNo');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
