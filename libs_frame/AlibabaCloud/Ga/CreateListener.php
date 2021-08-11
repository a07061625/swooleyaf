<?php

namespace AlibabaCloud\Ga;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method array getBackendPorts()
 * @method string getProtocol()
 * @method $this withProtocol($value)
 * @method string getAcceleratorId()
 * @method $this withAcceleratorId($value)
 * @method string getProxyProtocol()
 * @method $this withProxyProtocol($value)
 * @method array getPortRanges()
 * @method array getCertificates()
 * @method string getName()
 * @method $this withName($value)
 * @method string getClientAffinity()
 * @method $this withClientAffinity($value)
 */
class CreateListener extends Rpc
{
    /**
     * @return $this
     */
    public function withBackendPorts(array $backendPorts)
    {
        $this->data['BackendPorts'] = $backendPorts;
        foreach ($backendPorts as $depth1 => $depth1Value) {
            if (isset($depth1Value['FromPort'])) {
                $this->options['query']['BackendPorts.' . ($depth1 + 1) . '.FromPort'] = $depth1Value['FromPort'];
            }
            if (isset($depth1Value['ToPort'])) {
                $this->options['query']['BackendPorts.' . ($depth1 + 1) . '.ToPort'] = $depth1Value['ToPort'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withPortRanges(array $portRanges)
    {
        $this->data['PortRanges'] = $portRanges;
        foreach ($portRanges as $depth1 => $depth1Value) {
            if (isset($depth1Value['FromPort'])) {
                $this->options['query']['PortRanges.' . ($depth1 + 1) . '.FromPort'] = $depth1Value['FromPort'];
            }
            if (isset($depth1Value['ToPort'])) {
                $this->options['query']['PortRanges.' . ($depth1 + 1) . '.ToPort'] = $depth1Value['ToPort'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withCertificates(array $certificates)
    {
        $this->data['Certificates'] = $certificates;
        foreach ($certificates as $depth1 => $depth1Value) {
            if (isset($depth1Value['Id'])) {
                $this->options['query']['Certificates.' . ($depth1 + 1) . '.Id'] = $depth1Value['Id'];
            }
        }

        return $this;
    }
}
