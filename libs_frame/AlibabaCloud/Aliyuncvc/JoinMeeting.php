<?php

namespace AlibabaCloud\Aliyuncvc;

/**
 * @method string getUserId()
 * @method string getMeetingCode()
 */
class JoinMeeting extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserId($value)
    {
        $this->data['UserId'] = $value;
        $this->options['form_params']['UserId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMeetingCode($value)
    {
        $this->data['MeetingCode'] = $value;
        $this->options['form_params']['MeetingCode'] = $value;

        return $this;
    }
}
