<?php

namespace AlibabaCloud\Vpc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getVpnGatewayId()
 * @method $this withVpnGatewayId($value)
 * @method string getCallerBid()
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getIpsecServerName()
 * @method $this withIpsecServerName($value)
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 * @method array getIpsecServerId()
 */
class ListIpsecServers extends Rpc
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

    /**
     * @return $this
     */
    public function withIpsecServerId(array $ipsecServerId)
    {
        $this->data['IpsecServerId'] = $ipsecServerId;
        foreach ($ipsecServerId as $i => $iValue) {
            $this->options['query']['IpsecServerId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
