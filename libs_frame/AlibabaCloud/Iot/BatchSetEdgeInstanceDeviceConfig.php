<?php

namespace AlibabaCloud\Iot;

/**
 * @method array getDeviceConfigs()
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class BatchSetEdgeInstanceDeviceConfig extends Rpc
{
    /**
     * @return $this
     */
    public function withDeviceConfigs(array $deviceConfigs)
    {
        $this->data['DeviceConfigs'] = $deviceConfigs;
        foreach ($deviceConfigs as $depth1 => $depth1Value) {
            if (isset($depth1Value['IotId'])) {
                $this->options['query']['DeviceConfigs.' . ($depth1 + 1) . '.IotId'] = $depth1Value['IotId'];
            }
            if (isset($depth1Value['Content'])) {
                $this->options['query']['DeviceConfigs.' . ($depth1 + 1) . '.Content'] = $depth1Value['Content'];
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
