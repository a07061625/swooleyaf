<?php

namespace AlibabaCloud\Dts;

/**
 * @method string getSynchronizationJobId()
 * @method $this withSynchronizationJobId($value)
 * @method string getEndpointType()
 * @method string getAccountId()
 * @method $this withAccountId($value)
 * @method string getEndpointPort()
 * @method string getEndpointInstanceType()
 * @method string getSourceEndpointOwnerID()
 * @method string getSourceEndpointRole()
 * @method string getEndpointIP()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getEndpointInstanceId()
 * @method string getSynchronizationDirection()
 * @method $this withSynchronizationDirection($value)
 */
class SwitchSynchronizationEndpoint extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndpointType($value)
    {
        $this->data['EndpointType'] = $value;
        $this->options['query']['Endpoint.Type'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndpointPort($value)
    {
        $this->data['EndpointPort'] = $value;
        $this->options['query']['Endpoint.Port'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndpointInstanceType($value)
    {
        $this->data['EndpointInstanceType'] = $value;
        $this->options['query']['Endpoint.InstanceType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceEndpointOwnerID($value)
    {
        $this->data['SourceEndpointOwnerID'] = $value;
        $this->options['query']['SourceEndpoint.OwnerID'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceEndpointRole($value)
    {
        $this->data['SourceEndpointRole'] = $value;
        $this->options['query']['SourceEndpoint.Role'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndpointIP($value)
    {
        $this->data['EndpointIP'] = $value;
        $this->options['query']['Endpoint.IP'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndpointInstanceId($value)
    {
        $this->data['EndpointInstanceId'] = $value;
        $this->options['query']['Endpoint.InstanceId'] = $value;

        return $this;
    }
}
