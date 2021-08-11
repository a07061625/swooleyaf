<?php

namespace AlibabaCloud\Privatelink;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getEndpointId()
 * @method $this withEndpointId($value)
 * @method string getDryRun()
 * @method $this withDryRun($value)
 * @method string getIp()
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 */
class AddZoneToVpcEndpoint extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIp($value)
    {
        $this->data['Ip'] = $value;
        $this->options['query']['ip'] = $value;

        return $this;
    }
}
