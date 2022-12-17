<?php

namespace SyDingTalk\Oapi\Live;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.live.grouplive.sharelist request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.26
 */
class GroupLiveShareListRequest extends BaseRequest
{
    /**
     * 群id
     */
    private $cid;
    /**
     * 直播uuid
     */
    private $liveUuid;

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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.live.grouplive.sharelist';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->cid, 'cid');
        RequestCheckUtil::checkNotNull($this->liveUuid, 'liveUuid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
