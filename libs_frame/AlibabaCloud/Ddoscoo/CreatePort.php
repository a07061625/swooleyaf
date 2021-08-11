<?php

namespace AlibabaCloud\Ddoscoo;

/**
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getBackendPort()
 * @method $this withBackendPort($value)
 * @method string getFrontendProtocol()
 * @method $this withFrontendProtocol($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method array getRealServers()
 * @method string getFrontendPort()
 * @method $this withFrontendPort($value)
 */
class CreatePort extends Rpc
{
    /**
     * @return $this
     */
    public function withRealServers(array $realServers)
    {
        $this->data['RealServers'] = $realServers;
        foreach ($realServers as $i => $iValue) {
            $this->options['query']['RealServers.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
