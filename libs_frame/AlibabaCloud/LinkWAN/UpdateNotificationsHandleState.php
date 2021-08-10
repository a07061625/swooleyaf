<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method array getNotificationId()
 * @method string getTargetHandleState()
 */
class UpdateNotificationsHandleState extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /**
     * @return $this
     */
    public function withNotificationId(array $notificationId)
    {
        $this->data['NotificationId'] = $notificationId;
        foreach ($notificationId as $i => $iValue) {
            $this->options['form_params']['NotificationId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTargetHandleState($value)
    {
        $this->data['TargetHandleState'] = $value;
        $this->options['form_params']['TargetHandleState'] = $value;

        return $this;
    }
}
