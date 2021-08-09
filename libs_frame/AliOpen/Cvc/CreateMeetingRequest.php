<?php
namespace AliOpen\Cvc;

use AliOpen\Core\RpcAcsRequest;

/**
 * 
 *
 * Request of CreateMeeting
 *
 * @method string getMeetingName()
 * @method string getUserId()
 */
class CreateMeetingRequest extends RpcAcsRequest
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
            'CreateMeeting',
            'aliyuncvc'
        );
    }

    /**
     * @param string $meetingName
     *
     * @return $this
     */
    public function setMeetingName($meetingName)
    {
        $this->requestParameters['MeetingName'] = $meetingName;
        $this->queryParameters['MeetingName'] = $meetingName;

        return $this;
    }

    /**
     * @param string $userId
     *
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->requestParameters['UserId'] = $userId;
        $this->queryParameters['UserId'] = $userId;

        return $this;
    }
}
