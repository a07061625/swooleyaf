<?php

namespace SyDingTalk\Oapi\SceneServiceGroup;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.sceneservicegroup.group.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.09.08
 */
class GroupGetRequest extends BaseRequest
{
    /**
     * 开放群ID
     */
    private $openConversationid;

    public function setOpenConversationid($openConversationid)
    {
        $this->openConversationid = $openConversationid;
        $this->apiParas['open_conversationid'] = $openConversationid;
    }

    public function getOpenConversationid()
    {
        return $this->openConversationid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.sceneservicegroup.group.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->openConversationid, 'openConversationid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
