<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getRealTenantId()
 * @method $this withRealTenantId($value)
 * @method string getRealTripartiteKey()
 * @method $this withRealTripartiteKey($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method array getDevice()
 */
class BatchAddDeviceGroupRelations extends Rpc
{
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
    public function withDevice(array $device)
    {
        $this->data['Device'] = $device;
        foreach ($device as $depth1 => $depth1Value) {
            if (isset($depth1Value['DeviceName'])) {
                $this->options['query']['Device.' . ($depth1 + 1) . '.DeviceName'] = $depth1Value['DeviceName'];
            }
            if (isset($depth1Value['ProductKey'])) {
                $this->options['query']['Device.' . ($depth1 + 1) . '.ProductKey'] = $depth1Value['ProductKey'];
            }
        }

        return $this;
    }
}
