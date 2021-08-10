<?php

namespace AlibabaCloud\Slb;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getListenerProtocol()
 * @method $this withListenerProtocol($value)
 * @method array getLoadBalancerId()
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 */
class DescribeLoadBalancerListeners extends Rpc
{
    /**
     * @return $this
     */
    public function withLoadBalancerId(array $loadBalancerId)
    {
        $this->data['LoadBalancerId'] = $loadBalancerId;
        foreach ($loadBalancerId as $i => $iValue) {
            $this->options['query']['LoadBalancerId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
