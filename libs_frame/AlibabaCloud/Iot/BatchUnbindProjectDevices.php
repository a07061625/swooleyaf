<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getIotInstanceId()
 * @method string getProjectId()
 * @method array getDevices()
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class BatchUnbindProjectDevices extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIotInstanceId($value)
    {
        $this->data['IotInstanceId'] = $value;
        $this->options['form_params']['IotInstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectId($value)
    {
        $this->data['ProjectId'] = $value;
        $this->options['form_params']['ProjectId'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withDevices(array $devices)
    {
        $this->data['Devices'] = $devices;
        foreach ($devices as $depth1 => $depth1Value) {
            if (isset($depth1Value['DeviceName'])) {
                $this->options['form_params']['Devices.' . ($depth1 + 1) . '.DeviceName'] = $depth1Value['DeviceName'];
            }
            if (isset($depth1Value['ProductKey'])) {
                $this->options['form_params']['Devices.' . ($depth1 + 1) . '.ProductKey'] = $depth1Value['ProductKey'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiProduct($value)
    {
        $this->data['ApiProduct'] = $value;
        $this->options['form_params']['ApiProduct'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiRevision($value)
    {
        $this->data['ApiRevision'] = $value;
        $this->options['form_params']['ApiRevision'] = $value;

        return $this;
    }
}
