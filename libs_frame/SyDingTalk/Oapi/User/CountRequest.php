<?php

namespace SyDingTalk\Oapi\User;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.user.count request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.13
 */
class CountRequest extends BaseRequest
{
    /**
     * false 包含未激活钉钉的人员数量 true 只包含激活钉钉的人员数量
     */
    private $onlyActive;

    public function setOnlyActive($onlyActive)
    {
        $this->onlyActive = $onlyActive;
        $this->apiParas['only_active'] = $onlyActive;
    }

    public function getOnlyActive()
    {
        return $this->onlyActive;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.user.count';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->onlyActive, 'onlyActive');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
