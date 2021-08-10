<?php

namespace AlibabaCloud\Dts;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getNetworkType()
 * @method string getSourceEndpointInstanceType()
 * @method string getAccountId()
 * @method $this withAccountId($value)
 * @method string getSynchronizationJobClass()
 * @method $this withSynchronizationJobClass($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getDestRegion()
 * @method $this withDestRegion($value)
 * @method string getTopology()
 * @method $this withTopology($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getUsedTime()
 * @method $this withUsedTime($value)
 * @method string getDBInstanceCount()
 * @method $this withDBInstanceCount($value)
 * @method string getSourceRegion()
 * @method $this withSourceRegion($value)
 * @method string getPayType()
 * @method $this withPayType($value)
 * @method string getDestinationEndpointInstanceType()
 */
class CreateSynchronizationJob extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNetworkType($value)
    {
        $this->data['NetworkType'] = $value;
        $this->options['query']['networkType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceEndpointInstanceType($value)
    {
        $this->data['SourceEndpointInstanceType'] = $value;
        $this->options['query']['SourceEndpoint.InstanceType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDestinationEndpointInstanceType($value)
    {
        $this->data['DestinationEndpointInstanceType'] = $value;
        $this->options['query']['DestinationEndpoint.InstanceType'] = $value;

        return $this;
    }
}
