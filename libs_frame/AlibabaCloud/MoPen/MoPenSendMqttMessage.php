<?php

namespace AlibabaCloud\MoPen;

/**
 * @method string getPayload()
 * @method string getDeviceName()
 */
class MoPenSendMqttMessage extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPayload($value)
    {
        $this->data['Payload'] = $value;
        $this->options['form_params']['Payload'] = $value;

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
}
