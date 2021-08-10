<?php

namespace AlibabaCloud\Ecs;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method array getBandwidthPackage()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getVpcId()
 * @method $this withVpcId($value)
 * @method string getName()
 * @method $this withName($value)
 */
class CreateNatGateway extends Rpc
{
    /**
     * @return $this
     */
    public function withBandwidthPackage(array $bandwidthPackage)
    {
        $this->data['BandwidthPackage'] = $bandwidthPackage;
        foreach ($bandwidthPackage as $depth1 => $depth1Value) {
            if (isset($depth1Value['Bandwidth'])) {
                $this->options['query']['BandwidthPackage.' . ($depth1 + 1) . '.Bandwidth'] = $depth1Value['Bandwidth'];
            }
            if (isset($depth1Value['Zone'])) {
                $this->options['query']['BandwidthPackage.' . ($depth1 + 1) . '.Zone'] = $depth1Value['Zone'];
            }
            if (isset($depth1Value['IpCount'])) {
                $this->options['query']['BandwidthPackage.' . ($depth1 + 1) . '.IpCount'] = $depth1Value['IpCount'];
            }
        }

        return $this;
    }
}
