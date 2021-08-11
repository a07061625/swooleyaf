<?php

namespace AlibabaCloud\Cbn;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getCenId()
 * @method $this withCenId($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getUpdateInterval()
 * @method $this withUpdateInterval($value)
 * @method string getHost()
 * @method $this withHost($value)
 * @method string getHostRegionId()
 * @method $this withHostRegionId($value)
 * @method string getHostVpcId()
 * @method $this withHostVpcId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getAccessRegionIds()
 */
class ResolveAndRouteServiceInCen extends Rpc
{
    /**
     * @return $this
     */
    public function withAccessRegionIds(array $accessRegionIds)
    {
        $this->data['AccessRegionIds'] = $accessRegionIds;
        foreach ($accessRegionIds as $i => $iValue) {
            $this->options['query']['AccessRegionIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
