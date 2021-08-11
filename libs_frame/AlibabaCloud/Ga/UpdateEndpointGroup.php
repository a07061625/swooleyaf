<?php

namespace AlibabaCloud\Ga;

/**
 * @method array getPortOverrides()
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getHealthCheckIntervalSeconds()
 * @method $this withHealthCheckIntervalSeconds($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getHealthCheckProtocol()
 * @method $this withHealthCheckProtocol($value)
 * @method string getEndpointRequestProtocol()
 * @method $this withEndpointRequestProtocol($value)
 * @method string getHealthCheckPath()
 * @method $this withHealthCheckPath($value)
 * @method array getEndpointConfigurations()
 * @method string getEndpointGroupId()
 * @method $this withEndpointGroupId($value)
 * @method string getTrafficPercentage()
 * @method $this withTrafficPercentage($value)
 * @method string getHealthCheckPort()
 * @method $this withHealthCheckPort($value)
 * @method string getThresholdCount()
 * @method $this withThresholdCount($value)
 * @method string getEndpointGroupRegion()
 * @method $this withEndpointGroupRegion($value)
 * @method string getName()
 * @method $this withName($value)
 */
class UpdateEndpointGroup extends Rpc
{
    /**
     * @return $this
     */
    public function withPortOverrides(array $portOverrides)
    {
        $this->data['PortOverrides'] = $portOverrides;
        foreach ($portOverrides as $depth1 => $depth1Value) {
            if (isset($depth1Value['ListenerPort'])) {
                $this->options['query']['PortOverrides.' . ($depth1 + 1) . '.ListenerPort'] = $depth1Value['ListenerPort'];
            }
            if (isset($depth1Value['EndpointPort'])) {
                $this->options['query']['PortOverrides.' . ($depth1 + 1) . '.EndpointPort'] = $depth1Value['EndpointPort'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withEndpointConfigurations(array $endpointConfigurations)
    {
        $this->data['EndpointConfigurations'] = $endpointConfigurations;
        foreach ($endpointConfigurations as $depth1 => $depth1Value) {
            if (isset($depth1Value['Type'])) {
                $this->options['query']['EndpointConfigurations.' . ($depth1 + 1) . '.Type'] = $depth1Value['Type'];
            }
            if (isset($depth1Value['EnableClientIPPreservation'])) {
                $this->options['query']['EndpointConfigurations.' . ($depth1 + 1) . '.EnableClientIPPreservation'] = $depth1Value['EnableClientIPPreservation'];
            }
            if (isset($depth1Value['Weight'])) {
                $this->options['query']['EndpointConfigurations.' . ($depth1 + 1) . '.Weight'] = $depth1Value['Weight'];
            }
            if (isset($depth1Value['EnableProxyProtocol'])) {
                $this->options['query']['EndpointConfigurations.' . ($depth1 + 1) . '.EnableProxyProtocol'] = $depth1Value['EnableProxyProtocol'];
            }
            if (isset($depth1Value['Endpoint'])) {
                $this->options['query']['EndpointConfigurations.' . ($depth1 + 1) . '.Endpoint'] = $depth1Value['Endpoint'];
            }
        }

        return $this;
    }
}
