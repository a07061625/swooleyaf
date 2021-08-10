<?php

namespace AlibabaCloud\Sgw;

/**
 * @method string getGatewayClass()
 * @method $this withGatewayClass($value)
 * @method string getGatewayVersion()
 * @method $this withGatewayVersion($value)
 * @method array getDataDisk()
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getSecurityToken()
 * @method $this withSecurityToken($value)
 * @method string getGatewayId()
 * @method $this withGatewayId($value)
 */
class DeployGateway extends Rpc
{
    /**
     * @return $this
     */
    public function withDataDisk(array $dataDisk)
    {
        $this->data['DataDisk'] = $dataDisk;
        foreach ($dataDisk as $depth1 => $depth1Value) {
            if (isset($depth1Value['Size'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Size'] = $depth1Value['Size'];
            }
            if (isset($depth1Value['Category'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.Category'] = $depth1Value['Category'];
            }
            if (isset($depth1Value['CacheConfig'])) {
                $this->options['query']['DataDisk.' . ($depth1 + 1) . '.CacheConfig'] = $depth1Value['CacheConfig'];
            }
        }

        return $this;
    }
}
