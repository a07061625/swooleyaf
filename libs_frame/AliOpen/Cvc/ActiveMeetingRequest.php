<?php

namespace AliOpen\Cvc;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ActiveMeeting
 *
 * @method string getMeetingUUID()
 * @method string getMeetingCode()
 */
class ActiveMeetingRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'aliyuncvc',
            '2019-10-30',
            'ActiveMeeting',
            'aliyuncvc'
        );
    }

    /**
     * @param string $meetingUUID
     *
     * @return $this
     */
    public function setMeetingUUID($meetingUUID)
    {
        $this->requestParameters['MeetingUUID'] = $meetingUUID;
        $this->queryParameters['MeetingUUID'] = $meetingUUID;

        return $this;
    }

    /**
     * @param string $meetingCode
     *
     * @return $this
     */
    public function setMeetingCode($meetingCode)
    {
        $this->requestParameters['MeetingCode'] = $meetingCode;
        $this->queryParameters['MeetingCode'] = $meetingCode;

        return $this;
    }
}
