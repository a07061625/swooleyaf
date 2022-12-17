<?php

namespace SyDingTalk\Oapi\Kac;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.kac.openlive.white_users.batch_delete request
 *
 * @author auto create
 *
 * @since 1.0, 2021.09.28
 */
class OpenLiveWhiteUsersBatchDeleteRequest extends BaseRequest
{
    /**
     * 直播id
     */
    private $liveId;
    /**
     * 员工id列表
     */
    private $userIds;

    public function setLiveId($liveId)
    {
        $this->liveId = $liveId;
        $this->apiParas['live_id'] = $liveId;
    }

    public function getLiveId()
    {
        return $this->liveId;
    }

    public function setUserIds($userIds)
    {
        $this->userIds = $userIds;
        $this->apiParas['user_ids'] = $userIds;
    }

    public function getUserIds()
    {
        return $this->userIds;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.kac.openlive.white_users.batch_delete';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->liveId, 'liveId');
        RequestCheckUtil::checkNotNull($this->userIds, 'userIds');
        RequestCheckUtil::checkMaxListSize($this->userIds, 999, 'userIds');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
