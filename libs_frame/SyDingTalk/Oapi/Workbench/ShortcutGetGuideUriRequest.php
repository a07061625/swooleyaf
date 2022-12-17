<?php

namespace SyDingTalk\Oapi\Workbench;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.workbench.shortcut.getguideuri request
 *
 * @author auto create
 *
 * @since 1.0, 2021.06.07
 */
class ShortcutGetGuideUriRequest extends BaseRequest
{
    /**
     * ISV微应用ID
     */
    private $appId;

    public function setAppId($appId)
    {
        $this->appId = $appId;
        $this->apiParas['app_id'] = $appId;
    }

    public function getAppId()
    {
        return $this->appId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.workbench.shortcut.getguideuri';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->appId, 'appId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
