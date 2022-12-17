<?php

namespace SyDingTalk\Ccoservice\ServiceGroup;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.ccoservice.servicegroup.get request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class GetRequest extends BaseRequest
{
    /**
     * 服务群id
     */
    private $openGroupId;

    public function setOpenGroupId($openGroupId)
    {
        $this->openGroupId = $openGroupId;
        $this->apiParas['open_group_id'] = $openGroupId;
    }

    public function getOpenGroupId()
    {
        return $this->openGroupId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.ccoservice.servicegroup.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->openGroupId, 'openGroupId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
