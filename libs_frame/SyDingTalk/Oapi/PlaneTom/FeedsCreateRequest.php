<?php

namespace SyDingTalk\Oapi\PlaneTom;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.planetom.feeds.create request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.26
 */
class FeedsCreateRequest extends BaseRequest
{
    /**
     * 主播在组织内的id（staffId）
     */
    private $anchorId;
    /**
     * 约定开播时间戳（未来时间）
     */
    private $appointBeginTime;
    /**
     * 封面url
     */
    private $coverUrl;
    /**
     * 课程类型
     */
    private $feedType;
    /**
     * 1 chatId / 2 openConversationId，不传默认为OpenConversationId
     */
    private $groupIdType;
    /**
     * 绑定群列表,如果不传，默认为公开直播
     */
    private $groupIds;
    /**
     * 简介
     */
    private $introduction;
    /**
     * 开放平台中应用的appId
     */
    private $openAppId;
    /**
     * 图片简介url
     */
    private $picIntroductionUrl;
    /**
     * 预告片视频
     */
    private $preVideoUrl;
    /**
     * 课程标题
     */
    private $title;

    public function setAnchorId($anchorId)
    {
        $this->anchorId = $anchorId;
        $this->apiParas['anchor_id'] = $anchorId;
    }

    public function getAnchorId()
    {
        return $this->anchorId;
    }

    public function setAppointBeginTime($appointBeginTime)
    {
        $this->appointBeginTime = $appointBeginTime;
        $this->apiParas['appoint_begin_time'] = $appointBeginTime;
    }

    public function getAppointBeginTime()
    {
        return $this->appointBeginTime;
    }

    public function setCoverUrl($coverUrl)
    {
        $this->coverUrl = $coverUrl;
        $this->apiParas['cover_url'] = $coverUrl;
    }

    public function getCoverUrl()
    {
        return $this->coverUrl;
    }

    public function setFeedType($feedType)
    {
        $this->feedType = $feedType;
        $this->apiParas['feed_type'] = $feedType;
    }

    public function getFeedType()
    {
        return $this->feedType;
    }

    public function setGroupIdType($groupIdType)
    {
        $this->groupIdType = $groupIdType;
        $this->apiParas['group_id_type'] = $groupIdType;
    }

    public function getGroupIdType()
    {
        return $this->groupIdType;
    }

    public function setGroupIds($groupIds)
    {
        $this->groupIds = $groupIds;
        $this->apiParas['group_ids'] = $groupIds;
    }

    public function getGroupIds()
    {
        return $this->groupIds;
    }

    public function setIntroduction($introduction)
    {
        $this->introduction = $introduction;
        $this->apiParas['introduction'] = $introduction;
    }

    public function getIntroduction()
    {
        return $this->introduction;
    }

    public function setOpenAppId($openAppId)
    {
        $this->openAppId = $openAppId;
        $this->apiParas['open_app_id'] = $openAppId;
    }

    public function getOpenAppId()
    {
        return $this->openAppId;
    }

    public function setPicIntroductionUrl($picIntroductionUrl)
    {
        $this->picIntroductionUrl = $picIntroductionUrl;
        $this->apiParas['pic_introduction_url'] = $picIntroductionUrl;
    }

    public function getPicIntroductionUrl()
    {
        return $this->picIntroductionUrl;
    }

    public function setPreVideoUrl($preVideoUrl)
    {
        $this->preVideoUrl = $preVideoUrl;
        $this->apiParas['pre_video_url'] = $preVideoUrl;
    }

    public function getPreVideoUrl()
    {
        return $this->preVideoUrl;
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
        return 'dingtalk.oapi.planetom.feeds.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->anchorId, 'anchorId');
        RequestCheckUtil::checkNotNull($this->appointBeginTime, 'appointBeginTime');
        RequestCheckUtil::checkNotNull($this->feedType, 'feedType');
        RequestCheckUtil::checkMaxListSize($this->groupIds, 999, 'groupIds');
        RequestCheckUtil::checkNotNull($this->openAppId, 'openAppId');
        RequestCheckUtil::checkNotNull($this->title, 'title');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
