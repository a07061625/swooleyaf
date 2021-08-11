<?php

namespace AlibabaCloud\Vpc;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getSpec()
 * @method $this withSpec($value)
 * @method string getDuration()
 * @method $this withDuration($value)
 * @method string getNatType()
 * @method $this withNatType($value)
 * @method array getBandwidthPackage()
 * @method string getInstanceChargeType()
 * @method $this withInstanceChargeType($value)
 * @method string getAutoPay()
 * @method $this withAutoPay($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getInternetChargeType()
 * @method $this withInternetChargeType($value)
 * @method string getVpcId()
 * @method $this withVpcId($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getPricingCycle()
 * @method $this withPricingCycle($value)
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
            if (isset($depth1Value['InternetChargeType'])) {
                $this->options['query']['BandwidthPackage.' . ($depth1 + 1) . '.InternetChargeType'] = $depth1Value['InternetChargeType'];
            }
            if (isset($depth1Value['ISP'])) {
                $this->options['query']['BandwidthPackage.' . ($depth1 + 1) . '.ISP'] = $depth1Value['ISP'];
            }
            if (isset($depth1Value['IpCount'])) {
                $this->options['query']['BandwidthPackage.' . ($depth1 + 1) . '.IpCount'] = $depth1Value['IpCount'];
            }
        }

        return $this;
    }
}
