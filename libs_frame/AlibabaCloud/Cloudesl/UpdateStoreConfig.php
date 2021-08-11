<?php

namespace AlibabaCloud\Cloudesl;

/**
 * @method string getExtraParams()
 * @method string getStoreId()
 * @method string getEnableNotification()
 * @method string getNotificationWebHook()
 * @method string getNotificationSilentTimes()
 */
class UpdateStoreConfig extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtraParams($value)
    {
        $this->data['ExtraParams'] = $value;
        $this->options['form_params']['ExtraParams'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStoreId($value)
    {
        $this->data['StoreId'] = $value;
        $this->options['form_params']['StoreId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEnableNotification($value)
    {
        $this->data['EnableNotification'] = $value;
        $this->options['form_params']['EnableNotification'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNotificationWebHook($value)
    {
        $this->data['NotificationWebHook'] = $value;
        $this->options['form_params']['NotificationWebHook'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNotificationSilentTimes($value)
    {
        $this->data['NotificationSilentTimes'] = $value;
        $this->options['form_params']['NotificationSilentTimes'] = $value;

        return $this;
    }
}
