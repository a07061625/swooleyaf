<?php

namespace AlibabaCloud\Iot;

/**
 * @method array getDriverIds()
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class BatchGetEdgeDriver extends Rpc
{
    /**
     * @return $this
     */
    public function withDriverIds(array $driverIds)
    {
        $this->data['DriverIds'] = $driverIds;
        foreach ($driverIds as $i => $iValue) {
            $this->options['query']['DriverIds.' . ($i + 1)] = $iValue;
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
