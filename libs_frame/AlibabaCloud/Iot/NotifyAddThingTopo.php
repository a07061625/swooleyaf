<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getGwProductKey()
 * @method $this withGwProductKey($value)
 * @method string getDeviceListStr()
 * @method $this withDeviceListStr($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getGwIotId()
 * @method $this withGwIotId($value)
 * @method string getGwDeviceName()
 * @method $this withGwDeviceName($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class NotifyAddThingTopo extends Rpc
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
}
