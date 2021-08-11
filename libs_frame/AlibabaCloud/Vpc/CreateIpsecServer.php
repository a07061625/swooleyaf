<?php

namespace AlibabaCloud\Vpc;

/**
 * @method string getIkeConfig()
 * @method $this withIkeConfig($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getIpsecConfig()
 * @method $this withIpsecConfig($value)
 * @method string getPsk()
 * @method $this withPsk($value)
 * @method string getLocalSubnet()
 * @method $this withLocalSubnet($value)
 * @method string getIDaaSInstanceId()
 * @method $this withIDaaSInstanceId($value)
 * @method string getEffectImmediately()
 * @method $this withEffectImmediately($value)
 * @method string getClientIpPool()
 * @method $this withClientIpPool($value)
 * @method string getDryRun()
 * @method $this withDryRun($value)
 * @method string getVpnGatewayId()
 * @method $this withVpnGatewayId($value)
 * @method string getCallerBid()
 * @method string getPskEnabled()
 * @method $this withPskEnabled($value)
 * @method string getMultiFactorAuthEnabled()
 * @method $this withMultiFactorAuthEnabled($value)
 * @method string getIpSecServerName()
 * @method $this withIpSecServerName($value)
 */
class CreateIpsecServer extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCallerBid($value)
    {
        $this->data['CallerBid'] = $value;
        $this->options['query']['callerBid'] = $value;

        return $this;
    }
}
