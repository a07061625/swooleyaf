<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method array getDeviceInfo()
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class CreateLoRaNodesTask extends Rpc
{
    /**
     * @return $this
     */
    public function withDeviceInfo(array $deviceInfo)
    {
        $this->data['DeviceInfo'] = $deviceInfo;
        foreach ($deviceInfo as $depth1 => $depth1Value) {
            if (isset($depth1Value['PinCode'])) {
                $this->options['query']['DeviceInfo.' . ($depth1 + 1) . '.PinCode'] = $depth1Value['PinCode'];
            }
            if (isset($depth1Value['DevEui'])) {
                $this->options['query']['DeviceInfo.' . ($depth1 + 1) . '.DevEui'] = $depth1Value['DevEui'];
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
