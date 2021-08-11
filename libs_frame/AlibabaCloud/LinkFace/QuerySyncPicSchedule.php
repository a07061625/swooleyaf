<?php

namespace AlibabaCloud\LinkFace;

/**
 * @method string getIotId()
 * @method string getGroupId()
 * @method string getDeviceName()
 * @method string getProductKey()
 */
class QuerySyncPicSchedule extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIotId($value)
    {
        $this->data['IotId'] = $value;
        $this->options['form_params']['IotId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGroupId($value)
    {
        $this->data['GroupId'] = $value;
        $this->options['form_params']['GroupId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceName($value)
    {
        $this->data['DeviceName'] = $value;
        $this->options['form_params']['DeviceName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProductKey($value)
    {
        $this->data['ProductKey'] = $value;
        $this->options['form_params']['ProductKey'] = $value;

        return $this;
    }
}
