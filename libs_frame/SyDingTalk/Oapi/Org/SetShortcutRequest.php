<?php

namespace SyDingTalk\Oapi\Org;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.org.setshortcut request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class SetShortcutRequest extends BaseRequest
{
    /**
     * 微应用实例id列表
     */
    private $agentIds;

    public function setAgentIds($agentIds)
    {
        $this->agentIds = $agentIds;
        $this->apiParas['agentIds'] = $agentIds;
    }

    public function getAgentIds()
    {
        return $this->agentIds;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.org.setshortcut';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->agentIds, 20, 'agentIds');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
