<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getRealTenantId()
 * @method $this withRealTenantId($value)
 * @method string getRealTripartiteKey()
 * @method $this withRealTripartiteKey($value)
 * @method array getDeviceNameList()
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method array getDeviceName()
 */
class BatchCheckDeviceNames extends Rpc
{
    /**
     * @return $this
     */
    public function withDeviceNameList(array $deviceNameList)
    {
        $this->data['DeviceNameList'] = $deviceNameList;
        foreach ($deviceNameList as $depth1 => $depth1Value) {
            if (isset($depth1Value['DeviceNickname'])) {
                $this->options['query']['DeviceNameList.' . ($depth1 + 1) . '.DeviceNickname'] = $depth1Value['DeviceNickname'];
            }
            if (isset($depth1Value['DeviceName'])) {
                $this->options['query']['DeviceNameList.' . ($depth1 + 1) . '.DeviceName'] = $depth1Value['DeviceName'];
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

    /**
     * @return $this
     */
    public function withDeviceName(array $deviceName)
    {
        $this->data['DeviceName'] = $deviceName;
        foreach ($deviceName as $i => $iValue) {
            $this->options['query']['DeviceName.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
