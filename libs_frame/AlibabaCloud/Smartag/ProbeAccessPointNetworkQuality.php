<?php

namespace AlibabaCloud\Smartag;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method array getAccessPointIds()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getSmartAGId()
 * @method $this withSmartAGId($value)
 */
class ProbeAccessPointNetworkQuality extends Rpc
{
    /**
     * @return $this
     */
    public function withAccessPointIds(array $accessPointIds)
    {
        $this->data['AccessPointIds'] = $accessPointIds;
        foreach ($accessPointIds as $i => $iValue) {
            $this->options['query']['AccessPointIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
