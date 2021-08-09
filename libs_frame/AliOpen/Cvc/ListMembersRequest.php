<?php
namespace AliOpen\Cvc;

use AliOpen\Core\RpcAcsRequest;

/**
 * 
 *
 * Request of ListMembers
 *
 * @method string getMeetingUUID()
 */
class ListMembersRequest extends RpcAcsRequest
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
            'ListMembers',
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
}
