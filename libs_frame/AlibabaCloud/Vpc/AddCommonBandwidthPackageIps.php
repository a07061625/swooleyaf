<?php

namespace AlibabaCloud\Vpc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method array getIpInstanceIds()
 * @method string getBandwidthPackageId()
 * @method $this withBandwidthPackageId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getIpType()
 * @method $this withIpType($value)
 */
class AddCommonBandwidthPackageIps extends Rpc
{
    /**
     * @return $this
     */
    public function withIpInstanceIds(array $ipInstanceIds)
    {
        $this->data['IpInstanceIds'] = $ipInstanceIds;
        foreach ($ipInstanceIds as $i => $iValue) {
            $this->options['query']['IpInstanceIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
