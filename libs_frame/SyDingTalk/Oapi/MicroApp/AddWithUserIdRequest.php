<?php

namespace SyDingTalk\Oapi\MicroApp;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.microapp.addwithuserid request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class AddWithUserIdRequest extends BaseRequest
{
    /**
     * 微应用实例化id，表示企业和微应用的唯一关系
     */
    private $agentId;
    /**
     * 用户id列表，最多10个
     */
    private $userids;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agentId'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setUserids($userids)
    {
        $this->userids = $userids;
        $this->apiParas['userids'] = $userids;
    }

    public function getUserids()
    {
        return $this->userids;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.microapp.addwithuserid';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->agentId, 'agentId');
        RequestCheckUtil::checkNotNull($this->userids, 'userids');
        RequestCheckUtil::checkMaxListSize($this->userids, 20, 'userids');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
