<?php

namespace SyDingTalk\Oapi\Conference;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.conference.get request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class GetRequest extends BaseRequest
{
    /**
     * 会务Id
     */
    private $conferenceId;

    public function setConferenceId($conferenceId)
    {
        $this->conferenceId = $conferenceId;
        $this->apiParas['conference_id'] = $conferenceId;
    }

    public function getConferenceId()
    {
        return $this->conferenceId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.conference.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->conferenceId, 'conferenceId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
