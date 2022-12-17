<?php

namespace SyDingTalk\Oapi\Conference;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.conference.unpublish request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class UnPublishRequest extends BaseRequest
{
    /**
     * 会务id
     */
    private $conferenceId;
    /**
     * 操作用户id
     */
    private $userid;

    public function setConferenceId($conferenceId)
    {
        $this->conferenceId = $conferenceId;
        $this->apiParas['conference_id'] = $conferenceId;
    }

    public function getConferenceId()
    {
        return $this->conferenceId;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.conference.unpublish';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->conferenceId, 'conferenceId');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
