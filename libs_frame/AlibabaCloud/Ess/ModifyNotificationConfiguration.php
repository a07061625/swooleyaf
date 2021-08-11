<?php

namespace AlibabaCloud\Ess;

/**
 * @method string getScalingGroupId()
 * @method $this withScalingGroupId($value)
 * @method string getNotificationArn()
 * @method $this withNotificationArn($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getNotificationType()
 */
class ModifyNotificationConfiguration extends Rpc
{
    /**
     * @return $this
     */
    public function withNotificationType(array $notificationType)
    {
        $this->data['NotificationType'] = $notificationType;
        foreach ($notificationType as $i => $iValue) {
            $this->options['query']['NotificationType.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
