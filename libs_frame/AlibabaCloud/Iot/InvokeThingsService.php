<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getIdentifier()
 * @method $this withIdentifier($value)
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getArgs()
 * @method $this withArgs($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method array getDeviceName()
 */
class InvokeThingsService extends Rpc
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
    public function withDeviceName(array $deviceName)
    {
        $this->data['DeviceName'] = $deviceName;
        foreach ($deviceName as $i => $iValue) {
            $this->options['query']['DeviceName.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
