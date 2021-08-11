<?php

namespace AlibabaCloud\Iot;

/**
 * @method array getIotIds()
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class BatchUnbindDeviceFromEdgeInstance extends Rpc
{
    /**
     * @return $this
     */
    public function withIotIds(array $iotIds)
    {
        $this->data['IotIds'] = $iotIds;
        foreach ($iotIds as $i => $iValue) {
            $this->options['query']['IotIds.' . ($i + 1)] = $iValue;
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
