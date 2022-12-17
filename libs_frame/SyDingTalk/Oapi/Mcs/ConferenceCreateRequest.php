<?php

namespace SyDingTalk\Oapi\Mcs;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.mcs.conference.create request
 *
 * @author auto create
 *
 * @since 1.0, 2020.01.06
 */
class ConferenceCreateRequest extends BaseRequest
{
    /**
     * 由MCS颁发给调用三方的使用凭证
     */
    private $bizKey;
    /**
     * 是否推送通话记录
     */
    private $isPushRecord;
    /**
     * 倾向发起地 目前支持 CN-HZ/CN-HK/CN-BJ
     */
    private $preferenceRegion;
    /**
     * 视频会议从创建之时起的最多保留时间
     */
    private $roomValidTime;
    /**
     * 视频会议标题
     */
    private $title;

    public function setBizKey($bizKey)
    {
        $this->bizKey = $bizKey;
        $this->apiParas['biz_key'] = $bizKey;
    }

    public function getBizKey()
    {
        return $this->bizKey;
    }

    public function setIsPushRecord($isPushRecord)
    {
        $this->isPushRecord = $isPushRecord;
        $this->apiParas['is_push_record'] = $isPushRecord;
    }

    public function getIsPushRecord()
    {
        return $this->isPushRecord;
    }

    public function setPreferenceRegion($preferenceRegion)
    {
        $this->preferenceRegion = $preferenceRegion;
        $this->apiParas['preference_region'] = $preferenceRegion;
    }

    public function getPreferenceRegion()
    {
        return $this->preferenceRegion;
    }

    public function setRoomValidTime($roomValidTime)
    {
        $this->roomValidTime = $roomValidTime;
        $this->apiParas['room_valid_time'] = $roomValidTime;
    }

    public function getRoomValidTime()
    {
        return $this->roomValidTime;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        $this->apiParas['title'] = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.mcs.conference.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizKey, 'bizKey');
        RequestCheckUtil::checkNotNull($this->roomValidTime, 'roomValidTime');
        RequestCheckUtil::checkNotNull($this->title, 'title');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
