<?php

namespace SyDingTalk\Oapi\Live;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.live.grouplive.list request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class GroupLiveListRequest extends BaseRequest
{
    /**
     * 群id
     */
    private $cid;
    /**
     * 截止时间ms
     */
    private $fromTime;
    /**
     * 用户id
     */
    private $openId;
    /**
     * 开始时间ms
     */
    private $toTime;

    public function setCid($cid)
    {
        $this->cid = $cid;
        $this->apiParas['cid'] = $cid;
    }

    public function getCid()
    {
        return $this->cid;
    }

    public function setFromTime($fromTime)
    {
        $this->fromTime = $fromTime;
        $this->apiParas['from_time'] = $fromTime;
    }

    public function getFromTime()
    {
        return $this->fromTime;
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

    public function setToTime($toTime)
    {
        $this->toTime = $toTime;
        $this->apiParas['to_time'] = $toTime;
    }

    public function getToTime()
    {
        return $this->toTime;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.live.grouplive.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->cid, 'cid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
