<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.meetingroom.participant.list request
 *
 * @author auto create
 *
 * @since 1.0, 2021.08.03
 */
class MeetingRoomParticipantListRequest extends BaseRequest
{
    /**
     * 会议室预订id
     */
    private $bookid;
    /**
     * 分页游标
     */
    private $cursor;
    /**
     * 最大200(含)
     */
    private $size;

    public function setBookid($bookid)
    {
        $this->bookid = $bookid;
        $this->apiParas['bookid'] = $bookid;
    }

    public function getBookid()
    {
        return $this->bookid;
    }

    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
        $this->apiParas['cursor'] = $cursor;
    }

    public function getCursor()
    {
        return $this->cursor;
    }

    public function setSize($size)
    {
        $this->size = $size;
        $this->apiParas['size'] = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.meetingroom.participant.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bookid, 'bookid');
        RequestCheckUtil::checkNotNull($this->size, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
