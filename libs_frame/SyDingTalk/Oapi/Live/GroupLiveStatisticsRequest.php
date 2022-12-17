<?php

namespace SyDingTalk\Oapi\Live;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.live.grouplive.statistics request
 *
 * @author auto create
 *
 * @since 1.0, 2021.02.07
 */
class GroupLiveStatisticsRequest extends BaseRequest
{
    /**
     * 群id
     */
    private $cid;
    /**
     * 直播uuid
     */
    private $liveUuid;
    /**
     * 用户id
     */
    private $openId;

    public function setCid($cid)
    {
        $this->cid = $cid;
        $this->apiParas['cid'] = $cid;
    }

    public function getCid()
    {
        return $this->cid;
    }

    public function setLiveUuid($liveUuid)
    {
        $this->liveUuid = $liveUuid;
        $this->apiParas['live_uuid'] = $liveUuid;
    }

    public function getLiveUuid()
    {
        return $this->liveUuid;
    }

    public function setOpenId($openId)
    {
        $this->openId = $openId;
        $this->apiParas['open_id'] = $openId;
    }

    public function getOpenId()
    {
        return $this->openId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.live.grouplive.statistics';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->liveUuid, 'liveUuid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
