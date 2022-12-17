<?php

namespace SyDingTalk\Oapi\Calendar;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.calendar.list request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.26
 */
class ListRequest extends BaseRequest
{
    /**
     * 钉钉日历文件夹的对外id，默认是自己的默认文件夹
     */
    private $calendarFolderId;
    /**
     * 结果返回的最多数量，默认250，最多返回2500
     */
    private $maxResults;
    /**
     * 查询对应页，值有上一次请求返回的结果里对应nextPageToken
     */
    private $pageToken;
    /**
     * 是否需要展开循环日程
     */
    private $singleEvents;
    /**
     * 查询时间上限
     */
    private $timeMax;
    /**
     * 查询时间下限
     */
    private $timeMin;
    /**
     * 员工ID
     */
    private $userId;

    public function setCalendarFolderId($calendarFolderId)
    {
        $this->calendarFolderId = $calendarFolderId;
        $this->apiParas['calendar_folder_id'] = $calendarFolderId;
    }

    public function getCalendarFolderId()
    {
        return $this->calendarFolderId;
    }

    public function setMaxResults($maxResults)
    {
        $this->maxResults = $maxResults;
        $this->apiParas['max_results'] = $maxResults;
    }

    public function getMaxResults()
    {
        return $this->maxResults;
    }

    public function setPageToken($pageToken)
    {
        $this->pageToken = $pageToken;
        $this->apiParas['page_token'] = $pageToken;
    }

    public function getPageToken()
    {
        return $this->pageToken;
    }

    public function setSingleEvents($singleEvents)
    {
        $this->singleEvents = $singleEvents;
        $this->apiParas['single_events'] = $singleEvents;
    }

    public function getSingleEvents()
    {
        return $this->singleEvents;
    }

    public function setTimeMax($timeMax)
    {
        $this->timeMax = $timeMax;
        $this->apiParas['time_max'] = $timeMax;
    }

    public function getTimeMax()
    {
        return $this->timeMax;
    }

    public function setTimeMin($timeMin)
    {
        $this->timeMin = $timeMin;
        $this->apiParas['time_min'] = $timeMin;
    }

    public function getTimeMin()
    {
        return $this->timeMin;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        $this->apiParas['user_id'] = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.calendar.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->userId, 'userId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
