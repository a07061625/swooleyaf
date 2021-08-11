<?php

namespace AlibabaCloud\Vpc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method array getDhcpOptionsSetId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDhcpOptionsSetName()
 * @method $this withDhcpOptionsSetName($value)
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 */
class ListDhcpOptionsSets extends Rpc
{
    /**
     * @return $this
     */
    public function withDhcpOptionsSetId(array $dhcpOptionsSetId)
    {
        $this->data['DhcpOptionsSetId'] = $dhcpOptionsSetId;
        foreach ($dhcpOptionsSetId as $i => $iValue) {
            $this->options['query']['DhcpOptionsSetId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
