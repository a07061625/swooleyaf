<?php

namespace AlibabaCloud\Aliyuncvc;

/**
 * @method string getMeetingUUID()
 */
class GetMembers extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMeetingUUID($value)
    {
        $this->data['MeetingUUID'] = $value;
        $this->options['form_params']['MeetingUUID'] = $value;

        return $this;
    }
}
