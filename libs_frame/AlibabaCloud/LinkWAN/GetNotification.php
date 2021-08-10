<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getNotificationId()
 */
class GetNotification extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNotificationId($value)
    {
        $this->data['NotificationId'] = $value;
        $this->options['form_params']['NotificationId'] = $value;

        return $this;
    }
}
